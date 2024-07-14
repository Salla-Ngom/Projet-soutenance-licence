<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un Quiz</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            /* padding: 20px; */
        }

        .formulaire {
            background-color: white;
            /* padding: 30px; */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            /* margin: auto; */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
            color: #333;
        }

        .entete, .question {
            display: flex;
            justify-content: space-between;
            /* align-items: center; */
            margin-bottom: 15px;t[type="text"], .entete select {
            flex: 1;

        }

        .entete input, .question inpu        /* margin: 0 5px; */
            /* padding: 10px; */
            border: 1px solid #ccc;
            border-radius: 5px;
            /* font-size: 1rem; */
        }

        .reponse {
            display: flex;
            flex-direction: column;
            /* margin: 5px 0; */
        }

        .reponse input[type="text"] {
            flex: 1;
            /* margin: 5px 0; */
            /* padding: 8px; */
            border: 1px solid #ccc;
            border-radius: 5px;
            /* font-size: 1rem; */
        }

        .reponse label {
            /* margin-left: 10px; */
            /* font-size: 0.9rem; */
        }

        input[type="submit"] {
            background-color: #007BFF;
            /* padding: 12px 20px; */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            width: 100%;
            margin-top: 20px;
            /* font-size: 1.2rem; */
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="formulaire">
        <h1>Création de Quiz</h1>
        <form method="POST" action="{{ route('ajout-tp1') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <div class="entete">
                <input type="text" name="nomQuiz" placeholder="Nom du Quiz" required>
                <select id="matiere" name="matiere" required>
                    <option value="">Matière</option>
                    <option value="2">SVT</option>
                    <option value="1">Chimie</option>
                </select>
            </div>
            @for ($i = 1; $i <= 10; $i++)
                <div class="question">
                    <input type="text" name="questions[{{ $i }}][question]" placeholder="Question {{ $i }}" required>
                    @for ($j = 1; $j <= 4; $j++)
                        <div class="reponse">
                            <input type="text" name="questions[{{ $i }}][reponses][{{ $j }}][reponse]" placeholder="Réponse {{ $j }}" required>
                            <label>
                                <input type="radio" name="questions[{{ $i }}][reponses][{{ $j }}][is_correct]" value="1"> Vrai
                            </label>
                            <label>
                                <input type="radio" name="questions[{{ $i }}][reponses][{{ $j }}][is_correct]" value="0" checked> Faux
                            </label>
                        </div>
                    @endfor
                </div>
            @endfor
            <input type="submit" name="valider" value="Valider">
        </form>
    </div>
</body>

</html>
