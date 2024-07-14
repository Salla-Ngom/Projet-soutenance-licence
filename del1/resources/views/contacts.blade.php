<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header-container {
            /* display: flex; */
            /* justify-content: center; */
            /* background-color: #333; */
            padding: 10px 0;
        }
        .container {
            background-color: white;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 500px;
            width: 100%;
            margin: 50px auto;
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .contact-item {
            margin: 15px 0;
        }
        .contact-item a {
            text-decoration: none;
            color: #007BFF;
            font-size: 18px;
            display: inline-block;
            margin-top: 5px;
            transition: color 0.3s;
        }
        .contact-item a:hover {
            color: #0056b3;
        }
        .contact-icon {
            width: 30px;
            height: 30px;
            vertical-align: middle;
            margin-right: 10px;
        }
        .contact-details {
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <header class="header-container">
        @include('Layouts.menu_barre_tp')
    </header>
    <div class="container">
        <h1>Contactez-nous</h1>
        <div class="contact-item">
            <img src="https://img.icons8.com/color/48/000000/whatsapp.png" class="contact-icon" alt="WhatsApp">
            <p class="contact-details"><strong>WhatsApp :</strong> <a href="https://wa.me/782302977" target="_blank">782302977</a></p>
        </div>
        <div class="contact-item">
            <img src="https://img.icons8.com/color/48/000000/gmail.png" class="contact-icon" alt="Email">
            <p class="contact-details"><strong>E-mail :</strong> <a href="mailto:sakouxamxam5@gmail.com">sakouxamxam5@gmail.com</a></p>
        </div>
        <div class="contact-item">
            <img src="https://img.icons8.com/color/48/000000/phone.png" class="contact-icon" alt="Téléphone">
            <p class="contact-details"><strong>Téléphone :</strong> <a href="tel:772302977">772302977</a></p>
        </div>
        <div class="contact-item">
            <img src="https://img.icons8.com/color/48/000000/instagram-new.png" class="contact-icon" alt="Instagram">
            <p class="contact-details"><strong>Instagram :</strong> <a href="https://www.instagram.com/votre_nom_dutilisateur" target="_blank">Votre Instagram</a></p>
        </div>
    </div>
</body>
</html>
