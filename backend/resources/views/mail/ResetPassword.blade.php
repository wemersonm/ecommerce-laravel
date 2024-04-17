<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$subject}}</title>
</head>
<style>
    body {
        max-width: 670px;
        margin: 20px auto;
    }

    body a.link-call-center-page {
        color: #1E90FF;
    }

    body .body {
        opacity: 0.75;
    }
</style>

<body>
    <div class="header">Header</div>
    <div class="body">
        <p>Olá {{$name}}</p>
        <p>Recebemos uma solicitação de recuperação de senha. Para cadastrar uma nova senha acesse o link
            <a href="{{$url}}">"Clique aqui"</a>.
        </p>
        <p>Se não foi você quem mudou, entre em contato conosco através de nossa central de atendimento.</p>
        <a class="link_call_center_page" href="{{$link_call_center_page}}">{{$link_call_center_page}} </a>
        <p>Equipe {{$app_name}} </p>
    </div>
    <div class="footer">Footer</div>
</body>

</html>