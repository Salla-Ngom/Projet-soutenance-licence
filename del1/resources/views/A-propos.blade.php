<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos de Sakou Xam Xam</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header-container {
            padding: 10px 0;
        }
        .container {
            background-color: white;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 800px;
            width: 100%;
            margin: 50px auto;
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
            color: #333;
        }
        p {
            text-align: justify;
            color: #666;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <header class="header-container">
        @include('Layouts.menu_barre_tp')
    </header>
    <div class="container">
        <h1>À propos de Sakou Xam Xam</h1>
        <p>Sakou Xam Xam est une application innovante dédiée à l'enseignement pratique des hydrocarbures saturés et de la géologie. Face à la pénurie de laboratoires dans nos écoles et aux difficultés rencontrées par les élèves pour comprendre ces concepts, Sakou Xam Xam a été créé pour offrir une solution interactive et accessible.</p>

        <p>L'objectif de Sakou Xam Xam est de fournir un outil éducatif qui permet aux élèves de réaliser des expériences et des simulations réalistes, sans avoir besoin d'un laboratoire physique. Grâce à cette plateforme, les élèves peuvent explorer les propriétés des hydrocarbures saturés et les phénomènes géologiques de manière ludique et engageante.</p>

        <p>En utilisant Sakou Xam Xam, nous visons à combler le fossé entre la théorie et la pratique, facilitant ainsi une meilleure compréhension des sujets scientifiques. De plus, notre application est conçue pour être utilisée par les enseignants, leur permettant de suivre les progrès de leurs élèves et d'évaluer leur compréhension à travers des quiz interactifs et des travaux pratiques virtuels.</p>

        <p>Notre mission est de rendre l'apprentissage scientifique plus accessible et captivant, en utilisant les technologies modernes pour surmonter les limitations des ressources éducatives traditionnelles.</p>
    </div>
</body>
</html>
