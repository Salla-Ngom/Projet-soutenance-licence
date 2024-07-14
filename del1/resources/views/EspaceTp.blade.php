<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du TP</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('img/experience.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }

        header {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px 0;
            text-align: center;
        }

        .titre {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .titre h1 {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 2.5rem;
        }

        .description {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: justify;
            margin: 40px 10%;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .description p {
            font-size: 1.25rem;
            line-height: 1.6;
        }

        .jeu {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            height: 200px;
            margin-top: 20px;
            overflow: hidden;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .jeu img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .jeu .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .jeu:hover .overlay {
            opacity: 1;
        }

        .jeu .overlay p {
            color: white;
            font-size: 1.5rem;
            text-align: center;
            margin: 0;
        }
    </style>
</head>
<body>
    <header>
        @include('Layouts.menu_barre_tp')
    </header>
    <section class="jeu">
        <a href="{{$tp->chemin}}">
            <img src='/img/experience.jpg' alt="delmontero">
            <div class="overlay">
                <p>Cliquez ici pour faire le tp</p>
            </div>
        </a>
    </section>
    <div class="titre">
        <h1>{{$tp->titre}}</h1>
    </div>
    <main class="description">
        <p><i>{{$tp->description}}</i></p>
    </main>
</body>
</html>
