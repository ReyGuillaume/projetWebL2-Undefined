<?php

$db = new PDO("mysql:host=localhost;dbname=projetwebl2".';charset=UTF8',"root","root");

// ======================= Create User =======================
function create($db) {
    $stm = $db->prepare("INSERT INTO `order`(`id_user`, `id_cart`, `number`, `street`, `city`, `country`, `id_status`, `date`) VALUES (:id_user, :id_cart, :number, :street, :city, :country, :id_status, :date)");

    $stm->bindValue(":id_user", $_GET["id_user"]);
    $stm->bindValue(":id_cart", $_GET["id_cart"]);
    $stm->bindValue(":number", $_GET["number"]);
    $stm->bindValue(":street", $_GET["street"]);
    $stm->bindValue(":city", $_GET["city"]);
    $stm->bindValue(":country", $_GET["country"]);
    $stm->bindValue(":id_status", $_GET["id_status"]);
    $stm->bindValue(":date", $_GET["date"]);

    $stm->execute();
    echo json_encode($stm->fetchAll());
}

// ======================= Update User =======================
function update($db) {
    $stm = $db->prepare("UPDATE `order` SET `id_user`=:id_user, `id_cart`=:id_cart,`number`=:number, `street`=:street, `city`=:city, `country`=:country, `id_status`=:id_status WHERE id =:id");

    $stm->bindValue(":id", $_GET["id"]);
    $stm->bindValue(":id_user", $_GET["id_user"]);
    $stm->bindValue(":id_cart", $_GET["id_cart"]);
    $stm->bindValue(":number", $_GET["number"]);
    $stm->bindValue(":street", $_GET["street"]);
    $stm->bindValue(":city", $_GET["city"]);
    $stm->bindValue(":country", $_GET["country"]);
    $stm->bindValue(":id_status", $_GET["id_status"]);

    $stm->execute();
    echo json_encode($stm->fetchAll());
}

// ======================= Read User Data =======================
function read($db) {
    $stm = $db->prepare("SELECT * FROM `order`");
    $stm->execute();
    echo json_encode($stm->fetchAll());
}

// ======================= Delete Article =======================
function delete($db) {
    $stm = $db->prepare("DELETE FROM `order` WHERE id = :id");
    $stm->bindValue(":id", $_GET["id"]);
    $stm->execute();
    echo json_encode($stm->fetchAll());
}

switch($_GET["function"]) {
    case 'create': create($db); break;
    case 'read': read($db); break;
    case 'update': update($db); break;
    case 'delete': delete($db); break;
    default: echo "Not found!"; break;
}