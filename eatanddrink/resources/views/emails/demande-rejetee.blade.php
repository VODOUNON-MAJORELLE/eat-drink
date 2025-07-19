<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Réponse à votre demande - Eat&Drink</title>
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
        .notice {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
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
        <h2>Réponse à votre demande</h2>
    </div>
    
    <div class="content">
        <h3>Bonjour {{ $user->nom_entreprise }},</h3>
        
        <p>Nous avons examiné votre demande de stand pour l'événement <strong>Eat&Drink</strong>.</p>
        
        <div class="notice">
            <p><strong>Malheureusement, votre demande n'a pas pu être acceptée pour le moment.</strong></p>
        </div>
        
        <p><strong>Motif du rejet :</strong></p>
        <p style="background: #f8f9fa; padding: 15px; border-left: 4px solid #ff6b35; margin: 15px 0;">
            {{ $motif }}
        </p>
        
        <p><strong>Que pouvez-vous faire ?</strong></p>
        <ul>
            <li>Réviser votre demande en tenant compte du motif indiqué</li>
            <li>Nous contacter pour plus d'informations</li>
            <li>Soumettre une nouvelle demande à l'avenir</li>
        </ul>
        
        <p>Nous vous remercions de votre intérêt pour notre événement et espérons pouvoir vous accueillir lors d'une prochaine édition.</p>
        
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