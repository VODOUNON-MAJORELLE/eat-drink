<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Demande Approuvée - Eat&Drink</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #ff6b35 0%, #8b5cf6 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .button {
            display: inline-block;
            background: #ff6b35;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🍽️ Eat&Drink</h1>
        <h2>Félicitations !</h2>
    </div>
    
    <div class="content">
        <h3>Bonjour {{ $user->nom_entreprise }},</h3>
        
        <p>Nous avons le plaisir de vous informer que votre demande de stand pour l'événement <strong>Eat&Drink</strong> a été <strong>approuvée</strong> !</p>
        
        <p>Votre stand est maintenant actif et vous pouvez :</p>
        <ul>
            <li>Accéder à votre espace entrepreneur</li>
            <li>Ajouter vos produits</li>
            <li>Gérer vos commandes</li>
            <li>Suivre vos statistiques</li>
        </ul>
        
        <p><strong>Prochaines étapes :</strong></p>
        <ol>
            <li>Connectez-vous à votre compte</li>
            <li>Accédez à votre dashboard entrepreneur</li>
            <li>Commencez à ajouter vos produits</li>
        </ol>
        
        <div style="text-align: center;">
            <a href="{{ url('/login') }}" class="button">Accéder à mon espace</a>
        </div>
        
        <p>Si vous avez des questions, n'hésitez pas à nous contacter.</p>
        
        <p>Cordialement,<br>
        L'équipe Eat&Drink</p>
    </div>
    
    <div class="footer">
        <p>Cet email a été envoyé automatiquement. Merci de ne pas y répondre.</p>
        <p>© 2024 Eat&Drink - Tous droits réservés</p>
    </div>
</body>
</html> 