<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques Professeur</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            /* padding: 20px; */
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-header {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .card-body {
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Vos statistiques</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card text-white bg-primary">
                    <div class="card-header">Nombre de Quiz</div>
                    <div class="card-body">
                        {{ $nombreDeQuiz }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card text-white bg-success">
                    <div class="card-header">Note la plus élevée</div>
                    <div class="card-body">
                        {{ $maxNote ?? 'N/A' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card text-white bg-warning">
                    <div class="card-header">Note la plus basse</div>
                    <div class="card-body">
                        {{ $minNote ?? 'N/A' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card text-white bg-info">
                    <div class="card-header">Quiz le plus fait</div>
                    <div class="card-body">
                        {{ $quizLePlusFait ? $quizLePlusFait->titre_quiz . ' (' . $quizLePlusFait->notes_count . ' fois)' : 'N/A' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card text-white bg-danger">
                    <div class="card-header">Quiz le moins fait</div>
                    <div class="card-body">
                        {{ $quizLeMoinsFait ? $quizLeMoinsFait->titre_quiz . ' (' . $quizLeMoinsFait->notes_count . ' fois)' : 'N/A' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    {{-- @include("footer.pied"); --}}
</body>
</html>
