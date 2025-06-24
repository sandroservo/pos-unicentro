<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Boleto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            max-width: 600px;
            width: 90%;
        }

        h1 {
            font-size: 1.5rem;
            color: #111827;
        }

        iframe {
            margin-top: 20px;
            border: none;
            width: 100%;
            height: 600px;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        a:hover {
            background: #1d4ed8;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Parabéns, {{ $inscricao->nome }}!</h1>
        <p>
            O boleto da sua pós-graduação em <strong>{{ $inscricao->pos_graduacao }}</strong> foi gerado com sucesso.
        </p>
        <iframe src="{{ $linkBoleto }}" title="Visualizar Boleto"></iframe>
        <a href="{{ $linkBoleto }}" target="_blank">Abrir em Nova Aba</a>
    </div>
</body>

</html>
