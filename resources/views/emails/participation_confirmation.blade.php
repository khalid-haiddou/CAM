<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
</head>
<body>
    <p>Confirmation : pour équipe Crédit Agricole</p>
    <ul>
        <li><strong>Nom et Prénom :</strong> {{ $participant->first_name }} {{ $participant->last_name }}</li>
        <li><strong>Email :</strong> {{ $participant->email }}</li>
        <li><strong>Téléphone :</strong> {{ $participant->phone }}</li>
    </ul>
    <p>A confirmé sa présence via : www.camevents.ma</p>
</body>
</html>