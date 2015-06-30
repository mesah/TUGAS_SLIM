<?php

require "vendor/autoload.php";
require "vendor/db.php";
require "vendor/slim/slim/Slim/Slim.php";

$app = new \Slim\Slim();
//$app->get('/users','getUsers');



$app->get( '/delete1/', function ($id){
//        echo "Hello World";
        $sql = "Select from tb_hotel where id = $id";
        try {
            $db = getConn();
            $stmt = $db->query($sql);
            $hotels = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo '{"users":'. json_encode($hotels) . '}';
        } catch (Exception $exc) {
            echo '"error":"'. $exc->getMessage() .'"';
        }

    });
    
$app->get('/users','getUsers');
$app->get('/delete', 'delete');
$app->get('/update', 'Updates');
$app->get('/cari', 'getCari');
$app->run();

function getCari(){
    try{
    $cari = $_GET["cari"];
//$cari = "goreng";
        $query = "SELECT * from tb_hotel where nama LIKE '%$cari%'";
        $db = getConn();
        $stmt = $db->query($query);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"users": ' . json_encode($users) . '}';
        }catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
function getUsers() {
    $sql = "SELECT * from tb_hotel";
    try {
        $db = getConn();
        $stmt = $db->query($sql); 
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"users": ' . json_encode($users) . '}';
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    }

function Updates() {
    $nama = $_GET["nama"];
    $id =  $_GET["id"];
//    $id = $_GET["id"];
    $sql = "update tb_hotel set nama='$nama' where id=$id";
    try {
        $db = getConn();
        $stmt = $db->prepare($sql);
        $stmt->execute();  
        
       // echo '{"updates": ' . json_encode($updates) . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    }

function delete()
{
//    $id = 10;
    $id = $_GET["cari"];
    $sql = "DELETE FROM tb_hotel WHERE id = $id";
    try {
    $db = getConn();
    $stmt = $db->prepare($sql); 
    $stmt->bindParam("update_id", $update_id);
    $stmt->execute();
    $db = null;
    echo true;
    } catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



?>

