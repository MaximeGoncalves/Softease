<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Intervention</title>
</head>
<body>
<p>Vous avez une nouvelle intervention de prévu :
    <strong>{{ date('d M H:i', strtotime($ticket->appointment)) }}</strong></p>
<br>
<br>
<p><u>Rappel sur le ticket :</u></p>
<h3><strong>Objet : </strong>{{ $ticket->topic }}</h3>
<p><strong>Description : </strong>{!! $ticket->description !!}</p>
<p><strong>Société : </strong>{!! $ticket->user->society->name !!}</p>
<p><strong>Utilisateur : </strong>{!! $ticket->user->name !!}</p>
</body>
</html>