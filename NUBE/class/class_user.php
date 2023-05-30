<?php
    //print_r($stmt->errorInfo());
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include_once 'db.php';
    class user_class extends Database {  
        //name of the table
        private $table_name = "relojes";
        //name of the table's columns
        //public $id;
        //public $name;
        //public $last_name;
        //public $email;
        //public $password;

        //creation of the connection
        public function __construct(){    
            $this->conn = $this->getConnection();
        }

        //get all users
        public function getAllRelojes()
        {
            $stmt = $this->conn->prepare("
            SELECT
            `relojes`.`id` as 'reloj_id',
            `relojes`.`marca` as 'reloj_marca',
            `relojes`.`modelo` as 'reloj_modelo',
            `relojes`.`material_caja` as 'reloj_material_caja',
            `relojes`.`material_correa` as 'reloj_material_correa',
            `relojes`.`precio` as 'reloj_precio',
            `relojes`.`descripcion` as 'reloj_descripcion'
            FROM `relojes`
            ORDER by `relojes`.`id` ASC
            ");
            if ($stmt->execute()) {
                $result = array();
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $item = array(
                            'reloj_id' => $row['reloj_id'],
                            'reloj_marca' => $row['reloj_marca'],
                            'reloj_modelo' => $row['reloj_modelo'],
                            'reloj_material_caja' => $row['reloj_material_caja'],
                            'reloj_material_correa' => $row['reloj_material_correa'],
                            'reloj_precio' => $row['reloj_precio'],
                            'reloj_descripcion' => $row['reloj_descripcion']
                        );
                        array_push($result, $item);
                    }
                }
                return $result;
            } else {
                return false;
            }
        }
        
        // get one user
        public function getReloj($reloj_id)
        {
            $where_clause = '';
            if (isset($reloj_id))
                $where_clause = " WHERE `relojes`.`id` = $reloj_id";
            $stmt = $this->conn->prepare("
            SELECT
            `relojes`.`id` as 'reloj_id',
            `relojes`.`marca` as 'reloj_marca',
            `relojes`.`modelo` as 'reloj_modelo',
            `relojes`.`material_caja` as 'reloj_material_caja',
            `relojes`.`material_correa` as 'reloj_material_correa',
            `relojes`.`precio` as 'reloj_precio',
            `relojes`.`descripcion` as 'reloj_descripcion'
            FROM `relojes`
            $where_clause
            ORDER by `relojes`.`id` ASC
            ");
            if ($stmt->execute()) {
                $result = array();
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $item = array(
                            'reloj_id' => $row['reloj_id'],
                            'reloj_marca' => $row['reloj_marca'],
                            'reloj_modelo' => $row['reloj_modelo'],
                            'reloj_material_caja' => $row['reloj_material_caja'],
                            'reloj_material_correa' => $row['reloj_material_correa'],
                            'reloj_precio' => $row['reloj_precio'],
                            'reloj_descripcion' => $row['reloj_descripcion']
                        );
                        array_push($result, $item);
                    }
                }
                return $result;
            } else {
                return false;
            }
        }

        
        // Insertar reloj
public function insertReloj($marca, $modelo, $material_caja, $material_correa, $precio, $descripcion)
{
    $stmt = $this->conn->prepare("
    INSERT INTO `relojes` (`id`, `marca`, `modelo`, `material_caja`, `material_correa`, `precio`, `descripcion`) 
    VALUES (NULL, :marca, :modelo, :material_caja, :material_correa, :precio, :descripcion);
    ");
    $stmt->bindValue('marca', $marca);
    $stmt->bindValue('modelo', $modelo);
    $stmt->bindValue('material_caja', $material_caja);
    $stmt->bindValue('material_correa', $material_correa);
    $stmt->bindValue('precio', $precio);
    $stmt->bindValue('descripcion', $descripcion);
    
    if ($stmt->execute())
        return true;
    else
        return false;
}

        // Actualizar reloj
        public function updateReloj($id, $marca, $modelo, $material_caja, $material_correa, $precio, $descripcion)
        {
            $stmt = $this->conn->prepare("SELECT id FROM `relojes` WHERE `relojes`.`id` = :id;");
            $stmt->execute(array(':id' => $id));
            if ($stmt->rowCount()) {
                $stmt = $this->conn->prepare("
                UPDATE `relojes` SET 
                `marca` = :marca, 
                `modelo` = :modelo, 
                `material_caja` = :material_caja, 
                `material_correa` = :material_correa, 
                `precio` = :precio, 
                `descripcion` = :descripcion 
                WHERE `relojes`.`id` = :id;
                ");

                $stmt->bindValue('id', $id);
                $stmt->bindValue('marca', $marca);
                $stmt->bindValue('modelo', $modelo);
                $stmt->bindValue('material_caja', $material_caja);
                $stmt->bindValue('material_correa', $material_correa);
                $stmt->bindValue('precio', $precio);
                $stmt->bindValue('descripcion', $descripcion);
            
                if ($stmt->execute())
                    return true;
                else
                    return false;
            } else {
                return false;
            }
        }


        //update user
 // Eliminar reloj
        public function deleteReloj($id)
        {
            $stmt = $this->conn->prepare("DELETE FROM `relojes` WHERE `relojes`.`id` = :id");
            if ($stmt->execute(array('id' => $id)))
                return true;
            else
                return false;         
        }
        }
?>
