<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des Utilisateurs</title>
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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 10px 15px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }

        .btn-modifier {
            background-color: #4CAF50;
            color: white;
        }

        .btn-modifier:hover {
            background-color: #45a049;
        }

        .btn-supprimer {
            background-color: #f44336;
            color: white;
        }

        .btn-supprimer:hover {
            background-color: #e53935;
        }

        .active {
            color: green;
            font-weight: bold;
        }

        .inactive {
            color: red;
            font-weight: bold;
        }

        .button-approve {
            background-color: #4CAF50;
            color: white;
        }

        .button-approve:hover {
            background-color: #45a049;
        }

        .button-disapprove {
            background-color: #f44336;
            color: white;
        }

        .button-disapprove:hover {
            background-color: #e53935;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <h1>Liste des Admins</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $index => $admin)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $admin->prenom }}</td>
                    <td>{{ $admin->nom }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->phone }}</td>
                    <td>
                        <button class="btn btn-modifier"
                            onclick="modifierUtilisateur({{ $admin->id }})">Modifier</button>
                        <button class="btn btn-supprimer"
                            onclick="supprimerUtilisateur({{ $admin->id }})">Supprimer</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h1>Liste des Professeurs</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Etablissement</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($professeurs as $index => $professeur)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $professeur->prenom }}</td>
                    <td>{{ $professeur->nom }}</td>
                    <td>{{ $professeur->email }}</td>
                    <td>{{ $professeur->phone }}</td>
                    <td>{{ $professeur->Etablissement }}</td>
                    <td class="{{ $professeur->active ? 'active' : 'inactive' }}">
                        {{ $professeur->active ? 'Actif' : 'Inactif' }}
                    </td>
                    <td>
                        <button class="btn btn-modifier"
                            onclick="modifierUtilisateur({{ $professeur->id }})">Modifier</button>
                        <button class="btn button-approve" onclick="approveUser({{ $professeur->id }})">Activer</button>
                        <button class="btn button-disapprove"
                            onclick="disapproveUser({{ $professeur->id }})">Désactiver</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function modifierUtilisateur(id) {
            axios.get('/modifierUser/' + id)
                .then(function(response) {
                    document.getElementById('content').innerHTML = response.data;
                    addFormScript();
                })
                .catch(function(error) {
                    console.error('Erreur lors du chargement du formulaire de modification', error);
                });
        }

        function supprimerUtilisateur(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                // Faire une requête de suppression via AJAX
                axios.delete('/Supprimer-utilisateur/' + id)
                    .then(function(response) {
                        alert('Utilisateur supprimé avec succès');
                        location.reload(); // Recharger la page pour mettre à jour la liste
                    })
                    .catch(function(error) {
                        console.error('Erreur lors de la suppression de l\'utilisateur', error);
                        alert('Erreur lors de la suppression de l\'utilisateur');
                    });
            }
        }

    </script>
</body>

</html>
