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


                // if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST['submit'])) {

                    $fileName = "";

                    // Image pas obligatoire
                    if(isset($_FILES['file'])){
                        // Initialisation var:
                        $tmpName = $_FILES['file']['tmp_name'];
                        $name = $_FILES['file']['name'];
                        $size = $_FILES['file']['size'];
                        $error = $_FILES['file']['error'];

                        // Récupération de l'extension du fichier:
                        $tabExtension = explode('.', $name);
                        $extension = strtolower(end($tabExtension));
                        // Extensions autorisées :
                        $extensions = ['jpg', 'png', 'jpeg', "PNG", "JPG"];
                        // Max size: 40Mb 
                        $maxSize = 400000;

                        if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
                            // Php ajout d'un préfixe-id généré pour éviter écrasement ET prend le nom du produit pour le nommage :
                            // list($nameClean) = explode('.', $_POST["productName"]);
                            $uniqueName = uniqid($name, true);
                            $fileName = $uniqueName.".".$extension;

                            // Upload:
                            move_uploaded_file($tmpName, './uploads/'.$fileName);
                        }
                        else{
                            $_SESSION["success"] = "Le fichier est trop volumineux (>40Mb) ou n'est ni un PNG ni un JPG";
                            // echo "Le fichier est trop volumineux (>40Mb)";
                        }
                    }

                    $productName = filter_input(INPUT_POST, "productName", FILTER_UNSAFE_RAW);
                    $unitPrice = filter_input(INPUT_POST, "unitPrice", FILTER_VALIDATE_FLOAT);
                    $quantity = filter_input(INPUT_POST, "quantity", FILTER_VALIDATE_INT);
            
                    $newProduct = [
                        "productName" => $productName,
                        "unitPrice" => $unitPrice, 
                        "quantity" => $quantity,
                        "total" => ($quantity*$unitPrice),
                        // "imgPath" =>  "63ef5e103a9a4058517770.png"
                        "imgPath" =>  $fileName
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
                $_SESSION["success"] = "Vous avez retiré 1x " . $_SESSION['products'][$index]["productName"];
                header("Location:recap.php");

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
            break;


            // case "uploaderImg":
            //     $_SESSION["success"] = var_dump($_FILES);
            //     // $_SESSION["success"] = var_dump($_POST);
            // break;
        }

    } else {
        header("Location: index.php");
    }
    