<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Losowanie NBCT</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="/img/favicon.png">
</head>
<body>
<main>
    <div class="container">
        <div class="logo">
            <img src="img/logo.png" class="logo">
            <a class="montserrat-light" style="padding: 5px; font-size: 20px">Chcesz, żebyśmy sprawdzili twój kawałek?</a>
            <a class="montserrat-light" style="color: red">Pamiętaj o limicie 1 kawałka na osobę!</a>
        </div>
        <form method="post" action="add.php">
            <input type="text" name="link" require>
            <button class="montserrat-bold">dodaj link do kawałka</button>
        </form>
    </div>
</main>


</body>
</html>