<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #2c3e50;
            padding: 20px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        nav img {
            width: 150px;
            height: auto;
        }

        nav ul {
            list-style-type: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
        }

        nav ul li a {
            text-decoration: none;
            padding: 10px 20px;
            color: whitesmoke;
            border-radius: 20px;
            background-color: #34495e;
            transition: background-color 0.3s, color 0.3s;
        }

        nav ul li a:hover,
        nav ul li a.active {
            background-color: #1abc9c;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <img src="/img/Sakkou_Xam-xam_logo.png" alt="Logo">
            <ul>
                <li><a href="/">Accueil</a></li>
            </ul>

        </nav>
    </header>
</body>
</html>
