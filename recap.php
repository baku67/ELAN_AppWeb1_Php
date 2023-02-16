<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Récap des produits</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <?php
            // echo "Affichage variable \$_SESSION['product']<br>";
            // echo print_r($_SESSION["product"]) . "<br><br>";
            // var_dump($_SESSION["product"]);
            // echo "<br><br><br><br>";

            if (!isset($_SESSION["product"]) || empty($_SESSION["product"])) {
                echo "<p>Aucun produit en session...</p>";
            }
            else {
                echo 
                "<table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>";

                    $totalGeneral = 0;
                    foreach ($_SESSION["product"] as $index => $product) {
                        echo 
                        "<tr>",
                            "<td>".$index."</td>",
                            "<td>".$product["productName"]."</td>",
                            "<td>".number_format($product["unitPrice"], 2, ",", "&nbsp;")."&nbsp;€</td>",
                            "<td>".$product["quantity"]."</td>",
                            "<td>".number_format($product["total"], 2, ",", "&nbsp;")."&nbsp;€</td>",
                            // Suppression d'un produit dans le panier:
                            "<td><a id='deleteProduct' href='traitement.php?action=deleteProduct&id=" . $index . "'>&times;</a></td>",
                            "<td><a id='deleteProduct' href='traitement.php?action=minus1&id=" . $index . "'>-</a></td>",
                            "<td><a id='deleteProduct' href='traitement.php?action=plus1&id=" . $index . "'>+</a></td>",
                        "</tr>";
                        $totalGeneral += $product["total"];
                    }
                    echo 
                    "<tr>
                        <td colspan=4>Total général: </td>
                        <td><strong>" .number_format($totalGeneral, 2, ",", "&nbsp;") . "&nbsp;€</strong></td>
                    </tr>
                </tbody>
                </table>";

            }
        ?>

        
        <a href="traitement.php?action=clearShoppingCart">Vider le panier</a>


        
    </body>
</html>


