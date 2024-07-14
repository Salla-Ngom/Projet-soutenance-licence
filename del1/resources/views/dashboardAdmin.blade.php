<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Interface Admin</title>
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
            background-color: #333;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .contenu {
            padding: 20px;
            margin-top: 80px; /* Ajuster pour éviter de chevaucher la navbar */
            text-align: center;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 80px); /* Ajuster la hauteur disponible */
            overflow: auto;
            box-sizing: border-box;
            width: calc(100% - 250px); /* Ajuster la largeur pour tenir compte du menu vertical */
            margin-left: 250px; /* Place pour le menu vertical */
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
            overflow: hidden; /* Empêche le défilement complet */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
            padding-top: 80px; /* Ajuster pour aligner avec la navbar */
        }

        .menu-links {
            height: calc(100% - 200px); /* Ajuster la hauteur pour inclure le menu défilant */
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
    </style>
    <script>
         function approveUser(id) {
            axios.post('/users/activate/' + id, {
                    _token: '{{ csrf_token() }}'
                })
                .then(function(response) {
                    alert(response.data.success);
                    location.reload(); // Recharger la page pour mettre à jour la liste
                })
                .catch(function(error) {
                    console.error('Erreur lors de l\'activation de l\'utilisateur', error);
                    alert('Erreur lors de l\'activation de l\'utilisateur');
                });
        }

        function disapproveUser(id) {
            axios.post('/users/deactivate/' + id, {
                    _token: '{{ csrf_token() }}'
                })
                .then(function(response) {
                    alert(response.data.success);
                    location.reload(); // Recharger la page pour mettre à jour la liste
                })
                .catch(function(error) {
                    console.error('Erreur lors de la désactivation de l\'utilisateur', error);
                    alert('Erreur lors de la désactivation de l\'utilisateur');
                });
        }
        function fermerMenu() {
            const t = document.getElementById('vertical-menu');
            t.style.display = 'none';
        }

        function menuVertical() {
            const t = document.getElementById('vertical-menu');
            t.style.display = 'block';
        }

        function clic() {
            const t = document.getElementById('dropdown');
            if (t.style.display === 'none') {
                t.style.display = 'block';
            } else {
                t.style.display = 'none';
            }
        }

        function modifier() {
            console.log("Modifier le profil");
        }

        function supprimer() {
            console.log("Supprimer le profil");
        }

        function deconnecter() {
            console.log("Déconnexion");
        }
        function modifier(id) {
            axios.get('/modifierUser/' + {{ Auth::user()->id }}).then(function(response) {
                document.getElementById('content').innerHTML = response.data;
                // setTimeout(addFormScript, 500); // Ajouter un délai pour s'assurer que le DOM est complètement mis à jour
            }).catch(function(error) {
                console.error('Erreur lors du chargement du formulaire de modification', error);
            });
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

        // Fonction pour ajouter le script du formulaire dynamiquement
        function addFormScript() {
            const password = document.getElementById('MDP');
            const ConfPassword = document.getElementById('mdp2');
            const MSG = document.getElementById('message');
            const Bouton = document.getElementById('valider');
            if (password && ConfPassword && MSG && Bouton) {
                ConfPassword.addEventListener('input', () => {
                    if (password.value !== ConfPassword.value) {
                        MSG.style.display = 'block';
                        Bouton.disabled = true;
                    } else {
                        MSG.style.display = 'none';
                        Bouton.disabled = false;
                    }
                });
            }

            const roleSelect = document.getElementById('role');
            const etablissementInput = document.getElementById('etablissement');
            if (roleSelect && etablissementInput) {
                roleSelect.addEventListener('change', () => {
                    if (roleSelect.value === 'professeur') {
                        etablissementInput.style.display = 'block';
                    } else {
                        etablissementInput.style.display = 'none';
                    }
                });

                // Afficher l'input Etablissement si la valeur sélectionnée est professeur lors du chargement de la page
                if (roleSelect.value === 'professeur') {
                    etablissementInput.style.display = 'block';
                }
            }
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

        function supprimerUtilisateur(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
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
        document.addEventListener('DOMContentLoaded', function() {
            axios.get('/statsglobal').then(function(response) {
                document.getElementById('content').innerHTML = response.data;
            }).catch(function(error) {
                console.error('Erreur lors du chargement de la page des statistiques', error);
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
                <a href="#" id="stats">Statistiques</a>
                <a href="#" id="adduser">Nouveau Utilisateurs</a>
                <a href="#" id="listeUsers">Liste-Utilisateur</a>
                <a href="#" id="listeTps">Liste Tps</a>
                <a href="#" id="listeQuiz">Liste des quiz</a>
                <a href="#" id="Demande">Demande & suggession</a>
                <a href="#" id="profil">Profil</a>
                {{-- <a onclick="modifier()">Modifier</a> --}}
                {{-- <a onclick="supprimer()">Supprimer</a> --}}
            </div>
        </div>
        <main>
            <div class="contenu" id="content">
                <h1>Statistiques</h1>
            </div>
        </main>
        {{-- <footer> --}}
        {{-- &copy; Projet soutenance Licence 3 | Salla NGOM - Fatou KASSE --}}
        {{-- </footer> --}}
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            document.getElementById('listeUsers').addEventListener('click', function(e) {
                e.preventDefault();
                axios.get('Lister-user').then(function(response) {
                    document.getElementById('content').innerHTML = response.data;
                });
            });

            document.getElementById('listeTps').addEventListener('click', function(e) {
                e.preventDefault();
                axios.get('Lister-tp').then(function(response) {
                    document.getElementById('content').innerHTML = response.data;
                });
            });
            document.getElementById('listeQuiz').addEventListener('click', function(e) {
                e.preventDefault();
                axios.get('listerQuiz').then(function(response) {
                    document.getElementById('content').innerHTML = response.data;
                });
            });
            document.getElementById('stats').addEventListener('click', function(e) {
                e.preventDefault();
                axios.get('statsglobal').then(function(response) {
                    document.getElementById('content').innerHTML = response.data;
                }).catch(function(error) {
                    console.error('Erreur lors du chargement des statistiques', error);
                });
            });

            document.getElementById('adduser').addEventListener('click', function(e) {
                e.preventDefault();
                axios.get('Add-user').then(function(response) {
                    document.getElementById('content').innerHTML = response.data;
                    setTimeout(addFormScript,
                        100); // Ajouter un délai pour s'assurer que le DOM est complètement mis à jour
                });
            });
            document.getElementById('Demande').addEventListener('click', function(e) {
                e.preventDefault();
                axios.get('listeContact').then(function(response) {
                    document.getElementById('content').innerHTML = response.data;
                    setTimeout(addFormScript,
                        100); // Ajouter un délai pour s'assurer que le DOM est complètement mis à jour
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
            document.addEventListener('submit', function(event) {
                event.preventDefault();
                const form = event.target;
                const formData = new FormData(form);
                axios.post(form.action, formData)
                    .then(function(response) {
                        document.getElementById('content').innerHTML = '<div class="alert-success">' + response.data
                            .success + '</div>';
                        // Recharger le formulaire après l'ajout avec succès
                        axios.get('Add-user').then(function(response) {
                            document.getElementById('content').innerHTML += response.data;
                            setTimeout(addFormScript,
                                100
                            ); // Ajouter un délai pour s'assurer que le DOM est complètement mis à jour
                        });
                    })
                    .catch(function(error) {
                        console.error('Erreur lors de la soumission du formulaire', error);
                    });
            });
        </script>
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
    @else
        <script>
            window.location.href = "{{ url('/') }}";
        </script>
    @endif
</body>

</html>
