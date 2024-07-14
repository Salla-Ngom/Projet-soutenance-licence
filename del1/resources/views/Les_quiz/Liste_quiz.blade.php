<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            /* padding: 20px; */
        }

        .table-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            margin: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
            color: #333;
        }

        h2 {
            margin-top: 40px;
            font-size: 1.5rem;
            color: #333;
        }

        .no-quiz {
            text-align: center;
            color: #777;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <div class="container table-container">
        <h1>Liste des Quiz</h1>
        @foreach($matieres as $matiere)
            <h2>{{ $matiere->nom }}</h2>
            @if($matiere->quizzes->isEmpty())
                <p class="no-quiz">Aucun quiz disponible.</p>
            @else
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Titre du Quiz</th>
                            <th>Professeur</th>
                            <th>Etablissement</th>
                            <th>Note la plus élevée</th>
                            <th>Note la plus basse</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matiere->quizzes as $quiz)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $quiz->titre_quiz }}</td>
                                <td>{{ $quiz->professeur->prenom }} {{ $quiz->professeur->nom }}</td>
                                <td>{{ $quiz->professeur->Etablissement }}</td>
                                <td>{{ $quiz->notes->max('note') }}</td>
                                <td>{{ $quiz->notes->min('note') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('quiz.destroy', $quiz->id) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce quiz ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endforeach
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
