<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Page Chimie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f9f9f9;
            color: #333;
        }

        .corps {
            flex: 1;
            background-image: url('img/home.png');
            background-size: cover;
            background-repeat: no-repeat;
            text-align: center;
            color: whitesmoke;
        }

        .corps h1 {
            padding: 20px;
        }

        .para {
            margin: 0 5%;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 150px;
        }

        .citation {
            position: absolute;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .citation.active {
            opacity: 1;
        }

        header {
            background-color: #14f4f4;
            color: black;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }

        .card {
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .quiz-card {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .quiz-title {
            font-weight: bold;
        }

        .quiz-professor {
            color: #555;
        }
        .col-md-6 {
            margin-bottom: 10px;
        }
        .no-quiz {
            text-align: center;
            color: #777;
            font-size: 1.2rem;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const citations = document.querySelectorAll('.citation');
            let currentIndex = 0;

            function showNextCitation() {
                citations[currentIndex].classList.remove('active');
                currentIndex = (currentIndex + 1) % citations.length;
                citations[currentIndex].classList.add('active');
            }

            setInterval(showNextCitation, 10000);
        });
    </script>
</head>

<body>
    <header>
        @include('Layouts.Menu_Barre')
        <br>
    </header>
    <div class="corps">
        <h1>Bienvenue sur la page Svt (science de la vie et de la terre)</h1>
        <section>
            <div class="para">
                <div class="citation active">
                    <p><b><i>La géologie</i></b> est la science de la Terre. Elle est au cœur de nombreux défis
                        contemporains, de la compréhension des changements climatiques à la gestion durable des
                        ressources naturelles, en passant par la protection de l'environnement.</p>
                </div>
                <div class="citation">
                    <p><b><i>La géologie</i></b> permet de comprendre la structure et l'évolution de notre planète. Elle
                        ouvre des perspectives incroyables pour l'innovation dans les domaines de l'énergie, des
                        matériaux et de la gestion des risques géologiques.</p>
                </div>
                <div class="citation">
                    <p><b><i>La géologie</i></b>, contrairement à d'autres sciences, se distingue par son exploration de
                        la Terre à travers le temps et l'espace. Elle est à la fois une science fondamentale et
                        appliquée, influençant divers aspects de notre quotidien, de la gestion des ressources
                        naturelles à la prévention des risques naturels.</p>
                </div>
            </div>
        </section>
    </div>
    <main>
        <div class="container my-4">
            <h1 class="text-center">Liste des TP</h1>
            <div class="row">
                @foreach ($tps as $tp)
                    <div class="col-md-6 mb-6">
                        <div class="card" onclick="location.href='{{ route('EspaceTp', ['id' => $tp->id]) }}'">
                            <img class="card-img-top" src="img/Archéologue.png" alt="Image TP">
                            <div class="card-body">
                                <h5 class="card-title">{{ $tp->titre }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <h1 class="text-center">Liste des Quiz</h1>
            @if ($quizs->isEmpty())
                <p class="no-quiz">Aucun quiz disponible.</p>
            @else
                <div class="row">
                    @foreach ($quizs as $quiz)
                        <div class="col-md-4 mb-4">
                            <div class="card quiz-card"
                                onclick="location.href='{{ route('EspaceQuiz', ['id' => $quiz->id]) }}'">
                                <img class="card-img-top" src="img/istockphoto-870765174-612x612.jpg" alt="Image Quiz">
                                <div class="card-body">
                                    <h5 class="quiz-title">{{ $quiz->titre_quiz }}</h5>
                                    <p class="quiz-professor">{{ $quiz->professeur->prenom }}
                                        {{ $quiz->professeur->nom }}
                                    </p>
                                    <p class="quiz-professor">{{ $quiz->professeur->Etablissement }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>
    <footer>
        <p>Projet soutenance Licence 3 | Salla NGOM - Fatou KASSE</p>
    </footer>
</body>

</html>
