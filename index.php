<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>App Web 1</title>
    </head>

    <body>
        <form method="post" action="traitement.php" style="display:flex; flex-direction:column; width:70vw; margin:0 auto;">
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