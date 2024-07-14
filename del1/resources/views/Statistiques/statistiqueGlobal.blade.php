<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques Globales</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            width: 95%;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
            color: #333;
        }

        .card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 200px;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            color: white;
            font-size: 1.5rem;
        }

        .card.blue { background-color: #007BFF; }
        .card.green { background-color: #28a745; }
        .card.red { background-color: #dc3545; }
        .card.yellow { background-color: #ffc107; }
        .card.teal { background-color: #20c997; }

        .stats {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .chart-container {
            max-width: 600px;
            margin: auto;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Statistiques Globales</h1>
        <div class="stats">
            <div class="card blue">
                Nombre de Professeurs
                <div>{{ $nombreProfesseurs }}</div>
            </div>
            <div class="card green">
                Note la plus élevée
                <div>{{ $maxNote }}</div>
            </div>
            <div class="card yellow">
                Note la plus basse
                <div>{{ $minNote }}</div>
            </div>
            <div class="card teal">
                Quiz le plus fait
                <div>{{ $quizLePlusFait->titre_quiz }} ({{ $quizLePlusFait->attempts }} fois)</div>
                <div>Professeur: {{ $quizLePlusFait->professeur->prenom }} {{ $quizLePlusFait->professeur->nom }}</div>
                <div>Établissement: {{ $quizLePlusFait->professeur->Etablissement }}</div>
            </div>
            <div class="card red">
                Quiz le moins fait
                <div>{{ $quizLeMoinsFait->titre_quiz }} ({{ $quizLeMoinsFait->attempts }} fois)</div>
                <div>Professeur: {{ $quizLeMoinsFait->professeur->prenom }} {{ $quizLeMoinsFait->professeur->nom }}</div>
                <div>Établissement: {{ $quizLeMoinsFait->professeur->Etablissement }}</div>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="notesChart"></canvas>
        </div>
    </div>
    <script>
        var ctx = document.getElementById('notesChart').getContext('2d');
        var notesChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['≤ 5', '> 5 & < 10', '= 10', '> 10 & ≤ 15', '> 15 & < 20', '= 20'],
                datasets: [{
                    data: [{{ $notesInferieuresOuEgalesA5 }}, {{ $notesEntre5Et10 }}, {{ $notesEgalesA10 }}, {{ $notesEntre10Et15 }}, {{ $notesEntre15Et20 }}, {{ $notesEgalesA20 }}],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40']
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Répartition des notes'
                }
            }
        });
    </script>
</body>
</html>
