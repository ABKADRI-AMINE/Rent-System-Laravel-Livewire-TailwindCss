<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contrat de location</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
        }
        h1 {
            color: #8B0000;
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            margin-top: 50px;
        }
        h2 {
            font-size: 20px;
            color: #333;
            margin-top: 30px;
        }
        p {
            font-size: 16px;
            color: #333;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            border: 2px solid #8B0000;
            border-radius: 10px;
        }
        .text-right {
            text-align: right;
        }
        .text-bold {
            font-weight: bold;
        }
        .bg-gray {
            background-color: #f7f7f7;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Contrat de location</h1>
    <div class="bg-gray">
        <p>Objet loué : <span class="text-bold">{{ $objetLoue }}</span></p>
        <p>Description : {{ $description }}</p>
    </div>
    <div>
        <p>Client : <span class="text-bold">{{ $client }}</span></p>
        <p>Partenaire : <span class="text-bold">{{ $partenaire }}</span></p>
        <p>Date de début de la réservation : <span class="text-bold">{{ $reservation_Ddate }}</span></p>
        <p>Date de fin de la réservation : <span class="text-bold">{{ $reservation_Fdate }}</span></p>
        <p>Prix régulier de l'objet : <span class="text-bold">{{ $regular_price }} MAD</span></p>
        <p>Ville : <span class="text-bold">{{ $city }}</span></p>
    </div>
    <div class="text-right">
        <p>Fait à {{ $city }} le {{ $reservation_Ddate }}</p>
        <p>Signature du locataire :  {{ $client }} SIGNATURE</p>


    </div>
</div>
</body>
</html>
