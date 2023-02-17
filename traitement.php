<?php

    session_start();

    $_SESSION["success"] = "";

    if(isset($_GET["action"])) {

        // On chope l'id du produit (dans le cas ou l'action concerne un produit en particulier):
        if(isset($_GET["id"])) {
            $index = $_GET["id"];
        }


        // Actions:
        switch($_GET["action"]) {
            case "ajouterProduit":
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
                
                
                        $newProduct = [
                            "productName" => $productName,
                            "unitPrice" => $unitPrice, 
                            "quantity" => $quantity,
                            "total" => ($quantity*$unitPrice)
                        ];
                        $_SESSION["products"][] = $newProduct;
                
                        $_SESSION["success"] = "Le produit a bien été ajouté au panier";
                    }
                
                    header("Location:recap.php");
            break;        


            case "clearShoppingCart":
                unset($_SESSION['products']);
                header("Location:recap.php");

                $_SESSION["success"] = "Le panier a bien été vidé";
                
            break;



            // Actions sur un produit particulier:
            case "deleteProduct":
                $_SESSION["success"] = "Les " . strval($_SESSION['products'][$index]["quantity"])  . " produits " . strval($_SESSION['products'][$index]["productName"]) . " ont bien été supprimé du panier";

                unset($_SESSION['products'][$index]);
                header("Location:recap.php");


            break;



            case "plus1":
                $_SESSION['products'][$index]["quantity"] += 1;
                // Mise à jour du total ligne:
                $_SESSION['products'][$index]["total"] += $_SESSION['products'][$index]["unitPrice"];

                $_SESSION["success"] = "Vous avez ajouté 1x " . $_SESSION['products'][$index]["productName"];
                header("Location:recap.php");
            break;

            

            case "minus1":
                // Si que 1 produit, on le supprime si -1
                if ($_SESSION['products'][$index]["quantity"] == 1) {
                    unset($_SESSION['products'][$index]);
                }
                // Sinon -1
                else {
                    $_SESSION['products'][$index]["quantity"] -= 1;
                    // Mise à jour du total ligne:
                    $_SESSION['products'][$index]["total"] -= $_SESSION['products'][$index]["unitPrice"];
                }

                $_SESSION["success"] = "Vous avez retiré 1x " . $_SESSION['products'][$index]["productName"];
                header("Location:recap.php");
            break;
        }

    } else {
        header("Location: index.php");
    }
    