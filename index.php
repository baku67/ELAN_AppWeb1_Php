
<?php 
    
    session_start();
    
    ob_start();
    
        echo '
        <form method="post" action="traitement.php?action=ajouterProduit" id="form" enctype="multipart/form-data">
            <label for="productName">Nom du produit:</label>
            <input id="productName" name="productName" type="text" required>
            <label for="unitPrice">Prix à l\'unité:</label>
            <input id="unitPrice" name="unitPrice" type="number" onkeydown="return event.keyCode !== 69" required>
            <label for="quantity">Quantité désirée:</label>
            <input id="quantity" name="quantity" type="number" onkeydown="return event.keyCode !== 69" required>
            <label for="description">Description</label>
            <input id="description" name="description" type="textarea" required >
            <label>Image</label>
            <input type="file" name="file">
            <br>
            <input type="submit" value="Envoyer">
        </form>
        ';


    
    $content = ob_get_clean();
    
    $title = "Accueil";

    $onglet1 = "activ";
    $onglet2 = "";

    require "template.php";

?>