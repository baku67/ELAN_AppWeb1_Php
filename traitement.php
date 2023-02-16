<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (($_POST["productName"] === null) || ($_POST["unitPrice"] === null) || ($_POST["quantity"] === null)) {
            echo "Un des champ est vide";
        }

        $poductName = $_POST["productName"];
        $unitPrice = $_POST["unitPrice"];
        $quantity = $_POST["quantity"];

    }
