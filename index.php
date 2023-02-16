<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>App Web 1</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body> 

        <h1>Panier</h1><br>
        <nav>
            <ul id="navList">
                <li class='activ'>Accueil</li>
                <li><a href='recap.php'>Panier</a></li>
            </ul>
        </nav>

        <form method="post" action="traitement.php?action=ajouterProduit" id="form">
            <label for="productName">Nom du produit:</label>
            <input id="productName" name="productName" type="text" required>

            <label for="unitPrice">Prix à l'unité:</label>
            <input id="unitPrice" name="unitPrice" type="number" onkeydown="return event.keyCode !== 69" required>

            <label for="quantity">Quantité désirée:</label>
            <input id="quantity" name="quantity" type="number" onkeydown="return event.keyCode !== 69" required>
            <br>
            <input type="submit" >
        </form>
    </body>
</html>