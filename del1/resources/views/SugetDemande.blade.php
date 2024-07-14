<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des TPs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .button {
            padding: 10px 15px;
            margin: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
        }

        .button-approve {
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        .button-approve:hover {
            background-color: #45a049;
        }

        .button-disapprove {
            background-color: #f44336;
            color: white;
            border: none;
        }

        .button-disapprove:hover {
            background-color: #e53935;
        }
    </style>
</head>

<body>
    <h1>Les suggestions</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Suggestion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contSug as $cg)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cg->texte }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h1>Les demandes</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Établissement</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contDem as $cd)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cd->nom }}</td>
                    <td>{{ $cd->prenom }}</td>
                    <td>{{ $cd->email }}</td>
                    <td>{{ $cd->phone }}</td>
                    <td>{{ $cd->etablissement }}</td>
                    <td>
                        <button class="button button-approve" onclick="approveRequest('{{ $cd->nom }}', '{{ $cd->prenom }}', '{{ $cd->email }}', '{{ $cd->phone }}', '{{ $cd->etablissement }}')">Approuver</button>
                        <button class="button button-disapprove" onclick="disapproveRequest({{ $cd->id }})">Déapprouver</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function approveRequest(nom, prenom, email, phone, etablissement) {
            const data = {
                Nom: nom,
                prenom: prenom,
                phone: phone,
                Email: email,
                MDP: 'defaultpassword', // Vous pouvez demander à l'utilisateur de changer son mot de passe après la première connexion
                MDP_confirmation: 'defaultpassword',
                role: 'professeur',
                Etablissement: etablissement,
                _token: '{{ csrf_token() }}' // Assurez-vous que le token CSRF est inclus
            };

            fetch('/Add-user', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': data._token
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Utilisateur ajouté avec succès.');
                    location.reload(); // Recharger la page pour mettre à jour la liste
                } else {
                    alert('Erreur lors de l\'ajout de l\'utilisateur.');
                }
            })
            .catch(error => {
                console.error('Erreur lors de la requête:', error);
                alert('Erreur lors de la requête.');
            });
        }

        function disapproveRequest(id) {
            if (confirm('Êtes-vous sûr de vouloir déapprouver cette demande ?')) {
                alert('Demande ' + id + ' déapprouvée');
                // Vous pouvez ajouter une requête AJAX ici pour envoyer l'ID au backend pour traitement
            }
        }
    </script>
</body>

</html>
