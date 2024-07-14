<!--
# github.com/berru-g
# New refonte de mon premier https://codepen.io/h-lautre/pen/WNrbawy
# Script parallax by  Robert Gil Baptista-->

<head>
    <title>Accueil</title>
    <link rel="shortcut icon" href="src-img\icon-octocat.png" />
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        header {
            margin-top: 0px;
        }

        nav {
            background-color: transparent;
            /* margin-top: -1%; */
        }

        nav img {
            margin-top: 10px;
            width: 300px;
            height: 50;
        }

        nav ul {
            list-style-type: none;
            justify-content: flex-end;
            display: flex;
            margin-right: 4%;
            /* margin-top: -180px; */
            border-radius: 40px;
        }

        header ul li a {
            text-decoration: none;
            padding: 10px 15px;
            color: black;
            border-radius: 20px;
        }

        header ul li a:hover,
        header ul li a.active {
            background-color: black;
            color: white;
        }

        footer {
            bottom: 0;
            width: 100%;
            text-align: center;
            height: 5px;
        }

        section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;


        }

        .para {
            width: 500px;
            padding-left: 2%;
        }

        .para h1 {
            color: whitesmoke;
            display: flex;
            text-align: center;
            justify-content: center;
        }

        .para p {
            color: whitesmoke;
            font-family: 'Times New Roman', Times, serif;
            font-size: 1.5rem;
            text-align: justify;
            padding: 10px;
            border-radius: 10px;
        }

        .corps {
            background-image: url('img/home.png');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .motif {
            padding-right: 2%;
            margin-top: 10%;
        }

        .motif img {
            border-radius: 50% 45% 50% 45%;
            width: 300px;
            margin-right: 2%;

        }

        .bouton {
            width: 100px;
            cursor: pointer;
            background: #007bff;
            color: #fff;
            margin: 0 5% 0 0;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
        }

        .bouton:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <h1> <img  src="img/Sakkou_Xam-xam_logo.png" title="Dossier de presse 2022"></h1>
            <ul>
                 <li>
                    <a href="Espace-Admin" style="background-color: blue;">Connexion</a>
                </li>
                <li>
                    <a href="contacts">Contacts</a>
                </li>
                 <li>
                    <a href="Espace-Professeur">A-propos</a>
                </li>
            </ul>
        </nav>
    </header>
    </header>
    <div class="corps">
        <section>
            <div class="para">
                <h1>Bienvenue, sur</h1>
                <p><b><i>SAKKOU XAM XAM</i></b>, votre plateforme dédiée à l'apprentissage des sciences.
                    Nous offrons une large gamme de cours interactifs pour vous aider à mieux matriser les conceptes
                    théoriques et pratiques en science naturelle et chimique.
                    <br>
                </p>
                <a href="svt"><button class="bouton">svt</button></a>
                <a href="chimie"><button class="bouton">chimie</button></a>
            </div>
            <div class="motif">
                <img src="img/premium_vector-1682310629738-bf7e6472644a.png" alt="">
            </div>
        </section>
    </div>
    <footer>
        <div class="scale" >
            <p>Projet soutenance Licence 3 | Salla NGOM - Fatou KASSE</p>
        </div>
    </footer>

</body>
