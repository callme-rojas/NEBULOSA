<?php
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

//include_once 'class/db.php';
//$db = new Database();

//$db->getConnection();



include_once 'class/class_user.php';
$user = new user_class();
//var_dump( $user->getAllRelojes());

//print_r($user->getAllUsers());
//print_r($user->getUser(NULL, 'ana@univalle.edu'));
//print_r($user->getUser(1, NULL));

echo $user->insertReloj('Timex','Chronograph','Caucho','Caucho','19.000','xdsd');
//echo $user->updateUser(8,'juan','ortega','juan','123')
//echo $user->deleteUser(1);

?>
