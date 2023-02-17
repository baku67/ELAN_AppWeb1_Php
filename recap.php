


<?php
    session_start();



    ob_start();

        if (!isset($_SESSION["products"]) || empty($_SESSION["products"])) {
            echo "<p>Aucun produit en session...</p>";
        }
        else {
            echo 
            "<div id='tableDiv'><table>
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
                foreach ($_SESSION["products"] as $index => $product) {
                    echo 
                    "<tr class='shoppingCartLine'>",
                        "<td class='index'>".$index."</td>",
                        "<td>".$product["productName"]."</td>",
                        "<td>".number_format($product["unitPrice"], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "<td>".$product["quantity"]."</td>",
                        "<td>".number_format($product["total"], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        // Suppression d'un produit dans le panier:
                        "<td><a href='traitement.php?action=deleteProduct&id=" . $index . "' class='buttonShoppingCart deleteProduct'>&times;</a></td>",
                        "<td><a href='traitement.php?action=minus1&id=" . $index . "' class='buttonShoppingCart minus1Product'>-</a></td>",
                        "<td><a href='traitement.php?action=plus1&id=" . $index . "' class='buttonShoppingCart plus1Product'>+</a></td>",
                    "</tr>";
                    $totalGeneral += $product["total"];
                }
                echo 
                "<tr>
                    <td colspan=4>Total général: </td>
                    <td><strong>" .number_format($totalGeneral, 2, ",", "&nbsp;") . "&nbsp;€</strong></td>
                </tr>
            </tbody>
            </table></div>";

        }

        echo "
            <br><br>
            <a href='traitement.php?action=clearShoppingCart'>Vider le panier</a>
            <br>
            <a href='index.php'>Retour à l'accueil</a>";


    $content = ob_get_clean();

    $msg = $_SESSION["success"];


    $title = "Panier";

    $onglet1 = "";
    $onglet2 = "activ";

    require "template.php";

?>


