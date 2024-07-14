<!DOCTYPE html>
<html>

<head>
    <style>
       body, html{
           height: 100%;
           margin: 0;
           top: 0;
           font-family: 'Times New Roman', Times, serif;
           justify-content: center;
           align-items: center;
           background: linear-gradient(135deg,#73a5ff,#5477f5);
       }
        main{
            /* position: absolute; */
            justify-content: center;;
            align-items: center;
            text-align: center;
        }
        .formulaires{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 50px;
        }

        section.login {
            background: url('img/admin.jpg') no-repeat;
            width: 400px;
            height: 420px;
            background-size: cover;
            background-position: center;
            display: flex;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            overflow: hidden;

        }

        form {
            background: white;
            box-sizing: border-box;
            width: 50%;
            height: 420px;
            padding: 20px;
            flex-direction: column;
            display: flex;
            grid-gap: 20px;

        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        label {
            font-size: 14px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: rgb(100, 100, 100);
        }

        input {
            width: 160px;
            border: none;
            border-bottom: 2px solid #333;
            padding: 10px 0px;
            outline: none;
        }

        input:focus {
            border-bottom: 2px solid #e0c445;
        }

        button {
            margin-bottom: 20px;
            width: 140px;
            border: none;
            background: #333;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
            padding: 10px;
            box-shadow: 2px 2px 0px #e0c445;
        }

        button:hover {
            background: #e0c445;
            color: #333;
        }
        .alert{
            padding: 10px;
            background-color: #f44336;
            color: white;
            width: 500px;
            margin-bottom: 15px;
            text-align: center;
            margin-left: 30%;
         }
         .alert-danger{
            display: flex;
            justify-content: center;
            align-items: center;
            border-left: 6px solid #a94442;
         }

    </style>
</head>

<body>
    @include('Layouts.Menu_Barre')
    <main>
        <div>
            <h1 style="color: #333;">Bienvenue sur l'espace de connexion</h1>
            <p style="color: #666;">Veuillez vous connecter pour acceder à votre espace</p>
        </div>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <div class="formulaires">
            <section class="login">
                <form method="post">
                    @csrf
                    <h1>Log In</h1>
                    <div>
                        <label>Username</label>
                        <input type="email" name="email">
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="Password" name="password">
                    </div>
                    <button>Log In</button>
                    <div class="links">
                        <a href="/password_reset">Mot de passe oublié?</a>
                        <a href="registrer">Pas de compte? Demande d'inscription</a>
                    </div>
                </form>
            </section>
        </div>
    </main>
    <footer>
        <p>Projet soutenance Licence 3 | Salla NGOM - Fatou KASSE</p>
    </footer>
</body>

</html>
