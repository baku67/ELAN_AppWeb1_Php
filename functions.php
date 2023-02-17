<?php


    // $productCount = count($_SESSION["products"]);
    $total = 0;
    foreach($_SESSION["products"] as $product) {
        $total += $product["quantity"];
    }


    // $msg = $_SESSION["success"];


