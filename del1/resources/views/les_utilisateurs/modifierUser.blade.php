<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
        }
        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"],
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Modifier Utilisateur</h1>
        <form method="post" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('PUT')
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" value="{{ $user->prenom }}" required>

            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="{{ $user->nom }}" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required>

            <label for="phone">Téléphone:</label>
            <input type="text" id="phone" name="phone" value="{{ $user->phone }}" required>

            @if($user->role === 'professeur')
                <label for="etablissement">Etablissement:</label>
                <input type="text" id="etablissement" name="etablissement" value="{{ $user->Etablissement }}">
            @endif
            <label for="password">Nouveau mot de passe:</label>
            <input type="password" id="password" name="password">

            <label for="password_confirmation">Confirmer le nouveau mot de passe:</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
            <p id="message" style="color: red; display: none;">Les mots de passe ne correspondent pas.</p>
        <br><br>

            <input type="submit" value="Modifier">
        </form>
    </div>
    <script>
        document.addEventListener('submit', function(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            axios.post(form.action, formData)
                .then(function(response) {
                    const successMessage = document.getElementById('success-message');
                    successMessage.innerText = response.data.success;
                    successMessage.style.display = 'block';

                    // Charger la liste des utilisateurs après modification
                    axios.get('Lister-user')
                        .then(function(response) {
                            document.getElementById('content').innerHTML = response.data;
                        })
                        .catch(function(error) {
                            console.error('Erreur lors du chargement de la liste des utilisateurs', error);
                        });
                })
                .catch(function(error) {
                    console.error('Erreur lors de la soumission du formulaire', error);
                });
        });
    </script>
</body>
</html>
