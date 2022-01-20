<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
</head>
<body>
    <div style="text-align: center;">
        <img style="width: 120%;" src="{{public_path().'/images/semsa2.png'}}" />
    </div>
    <div style="margin-left: 20%; font-family: sans-serif">
        <h3>Nome:</h3>
        <h5>{{$comprovante->pessoa->nome_completo}}</h5>
        <h3>Cargo:</h3>
        <h5>{{$comprovante->pessoa->cargo->cargo}}</h5>
        <h3>Data de Inscrição:</h3>
        <h5>{{date('d-m-Y H:s', strtotime($comprovante->pessoa->created_at))}}</h5>
        <h3>Número de Protocolo:</h3>
        <h5>{{$comprovante->comprovante}}</h5>
    </div>
    <div style="margin-: 30%; text-align: center; margin-top: 30%;">

        <img style="width: 8%;" src="{{public_path().'/images/prefeitura.png'}}" />
        <br>
        <strong>Prefeitura de Rio Branco</strong>
    </div>
</body>
</html>
