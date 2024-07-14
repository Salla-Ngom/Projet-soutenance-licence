<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Profil Utilisateur</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-info img {
            border-radius: 50%;
            height: 150px;
            width: 150px;
            margin-bottom: 20px;
        }

        .profile-info table {
            width: 100%;
            border-collapse: collapse;
        }

        .profile-info th,
        .profile-info td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        .profile-info th {
            background-color: #f4f4f4;
            width: 30%;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 20px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        .button:hover {
            background-color: #45a049;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Profil Utilisateur</h1>
        <div class="profile-info">
            <img src="img/avatar6.png" alt="Profile Photo">
            <table>
                <tr>
                    <th>Prénom :</th>
                    <td>{{ $user->prenom }}</td>
                </tr>
                <tr>
                    <th>Nom :</th>
                    <td>{{ $user->nom }}</td>
                </tr>
                <tr>
                    <th>Email :</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Phone :</th>
                    <td>{{ $user->phone }}</td>
                </tr>
                @if ($user->Etablissement)
                <tr>
                    <th>Établissement :</th>
                    <td>{{ $user->Etablissement }}</td>
                </tr>
                @endif
            </table>
            <a href="#" onclick="modifier()" class="button">Modifier le profil</a>
        </div>
    </div>
    <footer>
        &copy; Projet soutenance Licence 3 | Salla NGOM - Fatou KASSE
    </footer>
</body>

</html>
