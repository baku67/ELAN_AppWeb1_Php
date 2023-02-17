<?php

    $total = 0;

    if (isset($_SESSION["products"])) {
        // $productCount = count($_SESSION["products"]);
        foreach($_SESSION["products"] as $product) {
            $total += $product["quantity"];
        }    
    }


    $msg = $_SESSION["success"];


