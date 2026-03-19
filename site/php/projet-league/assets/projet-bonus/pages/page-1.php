<?php
$heroName = $_GET['heroName'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>
        Le site dont vous êtes le héros
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;600;800&family=Special+Elite&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css" />
</head>
<body id="choice-grey-blue">
<main>
    <section>
        <h2>Que faites-vous ?</h2>
        <div>
            <form method="get" action="page-1-redirect.php">
                <input type="hidden" name="heroName" value="<?= $heroName ?>">
                <div>
                    <input type="radio" id="choice-1" name="choice" value="choice-1">
                    <label for="choice-1">Entrer par la grande porte</label>
                </div>
                <div>
                    <input type="radio" id="choice-2" name="choice" value="choice-2">
                    <label for="choice-2">Contourner le donjon par la forêt</label>
                </div>
                <div>
                    <input type="submit" value="Valider le choix" />
                </div>
            </form>
        </div>
    </section>
    <section>
        <section>
            <img src="../assets/img/door.png" />
            <h1><?php echo $heroName; ?>, vous arrivez devant un immense donjon en pierre. Une porte entrouverte laisse échapper une lueur orange. Un sentier s'enfonce dans la forêt sombre.</h1>
        </section>
    </section>
</main>
<script type="application/javascript" src="../assets/js/index.js"></script>
</body>
</html>
