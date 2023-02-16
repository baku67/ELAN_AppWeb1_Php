<?php

    session_start();

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
                        $_SESSION["product"][] = $newProduct;
                
                        // Test affichage d'une caractéristique du produit
                        // echo $_SESSION["user"]["productName"] . "<br>";
                    
                        // echo print_r($_SESSION["user"]) . "<br><br>";
                        // var_dump($_SESSION["user"]);
                    }
                
                    header("Location:recap.php");
            break;        


            case "clearShoppingCart":
                unset($_SESSION['product']);
                header("Location:recap.php");
                
            break;



            // Actions sur un produit particulier:
            case "deleteProduct":
                unset($_SESSION['product'][$index]);

                header("Location:recap.php");
            break;



            case "plus1":
                $_SESSION['product'][$index]["quantity"] += 1;
                // Mise à jour du total ligne:
                $_SESSION['product'][$index]["total"] += $_SESSION['product'][$index]["unitPrice"];
                header("Location:recap.php");
            break;

            

            case "minus1":
                // Si que 1 produit, on le supprime si -1
                if ($_SESSION['product'][$index]["quantity"] == 1) {
                    unset($_SESSION['product'][$index]);
                }
                // Sinon -1
                else {
                    $_SESSION['product'][$index]["quantity"] -= 1;
                    // Mise à jour du total ligne:
                    $_SESSION['product'][$index]["total"] -= $_SESSION['product'][$index]["unitPrice"];
                }
                header("Location:recap.php");
            break;
        }

    } else {
        header("Location: index.php");
    }
    
    
    
    
    
   
