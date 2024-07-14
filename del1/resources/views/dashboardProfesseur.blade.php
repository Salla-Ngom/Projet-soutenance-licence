<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Interface Professeur</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100%;
            overflow: hidden;
            background-color: #f4f4f4;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: blue;
            color: white;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .logo {
            height: 50px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
        }


        .profile-menu img {
            height: 100px;
            border-radius: 50%;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 20px;
            background-color: #333;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
            color: black;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: transparent;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .contenu {
            padding: 20px;
            margin-top: 80px;
            /* Ajuster pour éviter de chevaucher la navbar */
            text-align: center;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 80px);
            /* Ajuster la hauteur disponible */
            overflow: auto;
            box-sizing: border-box;
            width: calc(100% - 250px);
            /* Ajuster la largeur pour tenir compte du menu vertical */
            margin-left: 250px;
            /* Place pour le menu vertical */
            margin-bottom: 20px;
        }

        .contenu-inner {
            max-width: 100%;
            max-height: 100%;
            overflow: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .vertical-menu {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #333;
            color: white;
            overflow: hidden;
            /* Empêche le défilement complet */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
            padding-top: 80px;
            /* Ajuster pour aligner avec la navbar */
        }

        .menu-links {
            height: calc(100% - 200px);
            /* Ajuster la hauteur pour inclure le menu défilant */
            overflow-y: auto;
            padding: 10px 0;
        }

        .vertical-menu a {
            padding: 15px 20px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: background-color 0.3s ease;
        }

        .vertical-menu a:hover {
            background-color: #575757;
        }

        .vertical-menu a.active {
            background-color: #4CAF50;
            color: white;
        }

        .profile-menu {
            text-align: center;
            padding: 20px;
            border-bottom: 1px solid #575757;
        }

        .profile-menu h2 {
            margin: 10px 0 0;
            font-size: 18px;
        }

        .profile-menu p {
            margin: 5px 0;
            font-size: 14px;
            color: #bbb;
        }

        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        header{
            width: 100%;
        }
    </style>
    <script>
         function modifier(id) {
            axios.get('/modifierUser/' + {{ Auth::user()->id }}).then(function(response) {
                document.getElementById('content').innerHTML = response.data;
                // setTimeout(addFormScript, 500); // Ajouter un délai pour s'assurer que le DOM est complètement mis à jour
            }).catch(function(error) {
                console.error('Erreur lors du chargement du formulaire de modification', error);
            });
        }
        function fermerMenu() {
            document.getElementById('vertical-menu').style.display = 'none';
        }

        function menuVertical() {
            document.getElementById('vertical-menu').style.display = 'block';
        }

        function clic() {
            const dropdown = document.getElementById('dropdown');
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        }

        function modifierUtilisateur(id) {
            axios.get('/modifierUser/' + id).then(function(response) {
                document.getElementById('content').innerHTML = response.data;
                setTimeout(addFormScript,
                    500); // Ajouter un délai pour s'assurer que le DOM est complètement mis à jour
            }).catch(function(error) {
                console.error('Erreur lors du chargement du formulaire de modification', error);
            });
        }

        function supprimerUtilisateur() {
            if (confirm('Êtes-vous sûr de vouloir supprimer votre compte ?')) {
                axios.delete('/delete-account')
                    .then(function(response) {
                        alert('Votre compte a été supprimé avec succès');
                        window.location.href = '/';
                    })
                    .catch(function(error) {
                        console.error('Erreur lors de la suppression du compte', error);
                        alert('Erreur lors de la suppression du compte');
                    });
            }
        }

        // Pour fermer le menu déroulant si on clique en dehors
        window.onclick = function(event) {
            if (!event.target.matches('#profilePhoto')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === 'block') {
                        openDropdown.style.display = 'none';
                    }
                }
            }
        }


        // Charger la page des statistiques par défaut
        document.addEventListener('DOMContentLoaded', function() {
            axios.get('statistiques-professeur').then(function(response) {
                document.getElementById('content').innerHTML = response.data;
            }).catch(function(error) {
                console.error('Erreur lors du chargement des statistiques', error);
            });
        });
    </script>
</head>

<body>
    @if (Auth::check())
        <header>
            <div class="navbar">
                <img height="50" src="img/Sakkou_Xam-xam_logo.png" onclick="menuVertical()">
                <a href="dec" style="border: 1px solid red; background-color: red; margin-right:40px;">Deconnexion</a>
            </div>
            </div>
        </header>
        <div class="vertical-menu" id="vertical-menu">
            {{-- <img height="50" src="img/Sakkou_Xam-xam_logo.png" onclick="menuVertical()"> --}}
            <div class="profile-menu">
                <img src="img/avatar6.png" alt="Profile Photo" id="profilePhoto"><br>
                @if (Auth::user())
                    <h2>{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</h2>
                    <p>{{ Auth::user()->email }}</p>
                @endif
            </div>
            <div class="menu-links">
                <a href="#" id="stats">Mes statistiques</a>
                <a href="#" id="addquiz">Nouveau quiz</a>
                <a href="#" id="listequiz">Mes Quiz</a>
                <a href="#" id="profil">Profil</a>
                {{-- <a onclick="modifier()">Modifier</a> --}}
                {{-- <a onclick="supprimer()">Supprimer</a> --}}
            </div>
        </div>
        <main>
            <div class="contenu" id="content">
                <!-- Statistiques du professeur seront chargées ici par défaut -->
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            document.getElementById('addquiz').addEventListener('click', function(e) {
                e.preventDefault();
                axios.get('Ajout-tp/{{ Auth::user()->id }}').then(function(response) {
                    document.getElementById('content').innerHTML = response.data;
                });
            });
            document.getElementById('listequiz').addEventListener('click', function(e) {
                e.preventDefault();
                axios.get('mesQuiz').then(function(response) {
                    document.getElementById('content').innerHTML = response.data;
                });
            });
            document.getElementById('stats').addEventListener('click', function(e) {
                e.preventDefault();
                axios.get('statistiques-professeur').then(function(response) {
                    document.getElementById('content').innerHTML = response.data;
                }).catch(function(error) {
                    console.error('Erreur lors du chargement des statistiques', error);
                });
            });
            document.getElementById('profil').addEventListener('click', function(e) {
                e.preventDefault();
                axios.get('profil/{{ Auth::user()->id }}').then(function(response) {
                    document.getElementById('content').innerHTML = response.data;
                }).catch(function(error) {
                    console.error('Erreur lors du chargement des statistiques', error);
                });
            });
        </script>
    @else
        <script>
            window.location.href = "{{ url('/') }}";
        </script>
    @endif
</body>

</html>
