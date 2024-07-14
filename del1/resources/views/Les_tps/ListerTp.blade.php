<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des TPs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
    </style>
</head>
<body>
	<h1>liste tps</h1>
    @foreach($matieres as $matiere)
        <h1>{{ $matiere->nom }}</h1>
        @if($matiere->tps->isEmpty())
            <p>Aucun TP disponible pour {{ $matiere->nom }}.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matiere->tps as $tp)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tp->titre }}</td>
                            <td>{{ $tp->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endforeach
</body>
</html>

