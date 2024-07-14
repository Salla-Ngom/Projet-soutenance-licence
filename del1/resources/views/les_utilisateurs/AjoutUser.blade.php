<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Formulaire d'inscription</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    .formi {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f4f4f4;
    }

    .form11 {
      max-width: 400px;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form {
      margin: 0;
    }

    h2 {
      text-align: center;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="submit"],
    input[type="number"],
    select {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      color: #333;
      background-color: #f4f4f4;
      box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
      transition: background-color 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus,
    input[type="number"]:focus,
    select:focus {
      background-color: #fff;
      box-shadow: 0 0 5px #b4d5ff;
    }

    small {
      display: block;
      margin-top: 5px;
      font-size: 12px;
      color: red;
    }

    input[type="submit"] {
      margin-top: 10px;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
  <div class="formi">
    <div class="form11">
      <form method="post" action="{{ route('store') }}">
        <h2>FORMULAIRE D'INSCRIPTION</h2>
        @csrf
        <input type="text" id="Nom" name="Nom" placeholder="Nom" value="{{ old('Nom') }}" required>
        @error('Nom')
            <small>{{ $message }}</small>
        @enderror
        <br><br>

        <input type="text" id="prenom" name="prenom" placeholder="Prénom" value="{{ old('prenom') }}" required>
        @error('prenom')
            <small>{{ $message }}</small>
        @enderror
        <br><br>

        <input type="number" id="phone" name="phone" placeholder="Téléphone" value="{{ old('phone') }}" required>
        @error('phone')
            <small>{{ $message }}</small>
        @enderror
        <br><br>

        <input type="email" id="Email" name="Email" placeholder="Email" value="{{ old('Email') }}" required>
        @error('Email')
            <small>{{ $message }}</small>
        @enderror
        <br><br>

        <input type="password" id="MDP" name="MDP" placeholder="Mot de passe" aria-describedby="passwordHelpInline" minlength="8" maxlength="20" required>
        @error('MDP')
            <small>{{ $message }}</small>
        @enderror
        <small>Doit contenir entre 8 et 20 caractères.</small>
        <br><br>

        <input type="password" id="mdp2" name="MDP_confirmation" placeholder="Confirmation de mot de passe" required>
        <p id="message" style="color: red; display: none;">Les mots de passe ne correspondent pas.</p>
        <br><br>

        <label for="role">Profil :</label>
        <select id="role" name="role" required>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="professeur" {{ old('role') == 'professeur' ? 'selected' : '' }}>Professeur</option>
        </select>
        @error('role')
            <small>{{ $message }}</small>
        @enderror
        <br><br>

        <input type="text" id="etablissement" name="Etablissement" placeholder="Etablissement" value="{{ old('Etablissement') }}" style="display: none;">
        @error('Etablissement')
            <small>{{ $message }}</small>
        @enderror
        <br><br>

        <input class="val" type="submit" name="valider" id="valider" value="Valider">
      </form>
      <script>
        const password = document.getElementById('MDP');
        const ConfPassword = document.getElementById('mdp2');
        const MSG = document.getElementById('message');
        const Bouton = document.getElementById('valider');
        ConfPassword.addEventListener('input', () => {
          if (password.value !== ConfPassword.value){
            MSG.style.display ='block';
            Bouton.disabled = true;
          } else {
            MSG.style.display = 'none';
            Bouton.disabled = false;
          }
        });

        const roleSelect = document.getElementById('role');
        const etablissementInput = document.getElementById('etablissement');
        roleSelect.addEventListener('change',()=>{
            if(roleSelect.value === 'professeur'){
                etablissementInput.style.display= 'block';
            }else{
                etablissementInput.style.display= 'none';
            }
        });
        // Afficher l'input Etablissement si la valeur sélectionnée est professeur lors du chargement de la page
        if(roleSelect.value === 'professeur'){
            etablissementInput.style.display = 'block';
        }
        function validateForm() {
            alert("Formulaire soumis !");
            return true; // Retirez cette ligne si vous voulez arrêter la soumission pour le test
        }
      </script>
    </div>
  </div>
</body>
</html>
