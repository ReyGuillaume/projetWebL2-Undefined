<?php

include "../global/connexion.php";

// ======================= Create Article =======================
function create($db) {
    $stm = $db->prepare("INSERT INTO `article`(`name`, `id_size`, `id_subcategory`, `id_gender`, `id_brand`, `price`, `description`, `image`) VALUES (:name, :id_size, :id_subcategory, :id_gender, :id_brand, :price, :description, :image)");

    $stm->bindValue(":name", $_GET["name"]);
    $stm->bindValue(":id_size", $_GET["id_size"]);
    $stm->bindValue(":id_subcategory", $_GET["id_subcategory"]);
    $stm->bindValue(":id_gender", $_GET["id_gender"]);
    $stm->bindValue(":id_brand", $_GET["id_brand"]);
    $stm->bindValue(":price", $_GET["price"]);
    $stm->bindValue(":description", $_GET["description"]);
    $stm->bindValue(":image", $_GET["image"]);

    $stm->execute();
    echo json_encode($stm->fetchAll());
}

// ======================= Read Article Data =======================
function read($db) {
    $stm = $db->prepare("SELECT * FROM `article` WHERE id = :id");
    $stm->bindValue(":id", $_GET["id"]);
    $stm->execute();
    echo json_encode($stm->fetchAll());
}

// ======================= Read All Article Id =======================
function readAll($db) {
    $stm = $db->prepare("SELECT `id` FROM `article`");
    $stm->execute();
    echo json_encode($stm->fetchAll());
}

// ======================= Read All Article Data =======================
function readAllData($db) {
    $stm = $db->prepare("SELECT * FROM `article`");
    $stm->execute();
    echo json_encode($stm->fetchAll());
}

// ======================= Update Article =======================
function update($db) {
    $stm = $db->prepare("UPDATE `article` SET `name`=:name,`id_size`=:id_size,`id_subcategory`=:id_subcategory,`id_gender`=:id_gender,`id_brand`=:id_brand,`price`=:price,`description`=:description,`image`=:image WHERE id =:id");

    $stm->bindValue(":id", $_GET["id"]);
    $stm->bindValue(":name", $_GET["name"]);
    $stm->bindValue(":id_size", $_GET["id_size"]);
    $stm->bindValue(":id_subcategory", $_GET["id_subcategory"]);
    $stm->bindValue(":id_gender", $_GET["id_gender"]);
    $stm->bindValue(":id_brand", $_GET["id_brand"]);
    $stm->bindValue(":price", $_GET["price"]);
    $stm->bindValue(":description", $_GET["description"]);
    $stm->bindValue(":image", $_GET["image"]);

    $stm->execute();
    echo json_encode($stm->fetchAll());
}

// ======================= Delete Article =======================
function delete($db) {
    $stm = $db->prepare("DELETE FROM `article` WHERE id = :id");
    $stm->bindValue(":id", $_GET["id"]);
    $stm->execute();
    echo json_encode($stm->fetchAll());
}

include "./switch.php";