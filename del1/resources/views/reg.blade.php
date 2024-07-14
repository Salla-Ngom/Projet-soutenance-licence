<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Demande de compte</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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
        header {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px 0;
            text-align: center;
        }
        footer {
            bottom: 0;
            width: 100%;
            text-align: center;
            height: 5px;
        }
    </style>
</head>

<body>
    <header>
        @include('Layouts.menu_barre_tp')
    </header>
</br>
    <div class="container">
        <h1 class="text-center">Demander un compte</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('soumettreFormulaire') }}">
            @csrf
            <div id="additional-fields" class="hidden">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control" value="{{ old('nom') }}">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" value="{{ old('prenom') }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="phone">Numéro de téléphone</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>
                <div class="form-group">
                    <label for="etablissement">Etablissement</label>
                    <input type="text" id="etablissement" name="etablissement" class="form-control" value="{{ old('etablissement') }}">
                </div>
                <div class="form-group">
                    <label for="Tetablissement">Telephone de l'Etablissement</label>
                    <input type="text" id="Tetablissement" name="Tetablissement" class="form-control" value="{{ old('Tetablissement') }}">
                </div>
            </div>
            {{-- <div id="texte-field" class="form-group"> --}}
                {{-- <label for="texte">Texte</label> --}}
                {{-- <textarea id="texte" name="texte" class="form-control">{{ old('texte') }}</textarea> --}}
            {{-- </div> --}}
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div><br>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <footer>
        <div class="scale" >
            <p>Projet soutenance Licence 3 | Salla NGOM - Fatou KASSE</p>
        </div>
    </footer>
</body>

</html>
