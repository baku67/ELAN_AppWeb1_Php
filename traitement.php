<?php

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // if(isset($_POST['submit'])) {

        // En plus du *required* Front
        if (($_POST["productName"] === null) || ($_POST["unitPrice"] === null) || ($_POST["quantity"] === null)) {
            echo "Un des champ est vide";
        }

        // $productName = $_POST["productName"];
        $productName = filter_input(INPUT_POST, "productName", FILTER_UNSAFE_RAW);
        // $unitPrice = $_POST["unitPrice"];
        $unitPrice = filter_input(INPUT_POST, "unitPrice", FILTER_VALIDATE_FLOAT);
        // $quantity = $_POST["quantity"];
        $quantity = filter_input(INPUT_POST, "quantity", FILTER_VALIDATE_INT);

        $newProduct = [$productName, $unitPrice, $quantity];
        $_SESSION["user"]= $newProduct;
        echo implode($_SESSION["user"]);
    
    }

    header("Location:index.php");
