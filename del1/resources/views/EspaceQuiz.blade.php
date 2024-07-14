<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $quiz->titre_quiz }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
            color: #333;
        }

        .question {
            margin-bottom: 20px;
        }

        .question h3 {
            margin-bottom: 10px;
        }

        .reponse {
            margin-bottom: 10px;
        }

        .reponse label {
            font-size: 1rem;
        }

        .alert-success {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            text-align: center;
        }

        .submit-container {
            text-align: center;
            margin-top: 20px;
        }

        .submit-container button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
        }

        .submit-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        @include('Layouts.menu_barre_tp')
    </header><br><br>
    <div class="container">
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1>{{ $quiz->titre_quiz }}</h1>
        <form method="POST">
            @csrf
            @foreach($quiz->question as $index => $question)
                <div class="question">
                    <h3>Question {{ $index + 1 }}: {{ $question->contenu }}</h3>
                    @foreach($question->reponse as $reponse)
                        <div class="reponse">
                            <label>
                                <input type="radio" name="question_{{ $question->id }}" value="{{ $reponse->id }}">
                                {{ $reponse->reponse }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach
            <div class="submit-container">
                <button type="submit">Valider</button>
            </div>
        </form>
    </div>
</body>
</html>
