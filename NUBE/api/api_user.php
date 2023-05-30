<?php 
    //include_once 'api_tools.php';
    header("Content-Type: application/json; charset=UTF-8");
    include_once '../class/class_user.php';
    
    $user = new user_class();

    switch($_SERVER['REQUEST_METHOD']){
        

        case 'GET': //get a single o list
            
            
            if(isset($_GET['id'])){
                $getId = $user->getReloj($_GET['id']);
                if(is_array($getId))
                {
                    $result["data"] = $getId;
                    $result["status"] = 'success';
                }
                else
                {
                    $result["status"] = "error";
                    $result["message"] = "Unable to communicate with database";                       
                }
            }
            else{
                $getAll = $user->getAllRelojes();
                if(is_array($getAll))
                {
                    $result["data"] = $getAll;
                    $result["status"] = 'success';
                }
                else
                {
                    $result["status"] = "error";
                    $result["message"] = "Unable to communicate with database";                       
                } 
            }
        break;   
        case 'POST': // create
            $_POST = json_decode(file_get_contents('php://input'), true);
            if ($user->insertReloj($_POST['marca'], $_POST['modelo'], $_POST['material_caja'], $_POST['material_correa'], $_POST['precio'], $_POST['descripcion'])) {
                $result["status"] = 'success';
                $result["data"] = null;
            } else {
                $result["status"] = 'error';
                $result["message"] = "Error inserting reloj";
            }
            break;

            case 'DELETE': // delete
                $_DELETE = json_decode(file_get_contents('php://input'), true);
                $deleteId = $user->deleteReloj($_DELETE['id']);
                if ($deleteId) {
                    $result["data"] = null;
                    $result["status"] = 'success';    
                } else {
                    $result["status"] = "error";
                    $result["message"] = "Error deleting reloj";
                }
                break;
                
                case 'PUT': // update
                    $_PUT = json_decode(file_get_contents('php://input'), true);
                    $updateId = $user->updateReloj($_PUT['id'], $_PUT['marca'], $_PUT['modelo'], $_PUT['material_caja'], $_PUT['material_correa'], $_PUT['precio'], $_PUT['descripcion']);
                    if ($updateId) {
                        $result["data"] = null;
                        $result["status"] = 'success';
                    } else {
                        $result["status"] = "error";
                        $result["message"] = "Error updating reloj";
                    }
                    break;
                
                default:
                    $result["status"] = "error";
                    $result["message"] = "Unknown request";
                
             
    }
    echo json_encode($result);
?>