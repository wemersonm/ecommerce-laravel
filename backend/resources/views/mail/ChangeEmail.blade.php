<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>[{{ config('app.name') }}] Recuperar Senha</title>
</head>
<style>
    .container-email {
        background-color: #f2f2f2;
        padding: 10px;
        box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.5);
    }

    .url {
        font-size: small;
        color: rgb(77, 77, 239);

    }

    .footer {
        text-align: center;
        padding-top: 20px;
        color: #888;
        font-size: 14px;
    }
</style>

<body>
    <div class="container-email">
        <h2>Redefinição de Email do {{ config('app.name') }}</h2>
        <p>Olá, <strong>{{ $name }}</strong>,</p>
        <p>Você está recebendo este e-mail porque solicitou mudança de <b>Email</b> para sua conta.</p>
        <p>
            Se você solicitou a redefinição de <b>Email</b>, clique no link abaixo para <b>CONFIRMAR</b> a mudança de
            <b>email</b>
        </p>
        <a href="{{ $url }}"
            style="display: inline-block; padding: 10px 20px; background-color: #3498db; color: #fff; text-decoration: none; border-radius: 5px;">
            Confirmar Mudança de Email</a>
        <p>
        <p>Ou simplesmente, copie e cole o link abaixo no seu navegador</p>
        <p>{{ $url }}</p>
        Se você não solicitou a redefinição de email, nenhuma ação adicional é necessária.
        </p>
        <p>Obrigado!</p>
        <div class="footer">
            <p>Atenciosamente,<br>{{ config('mail.from.name') }}</p>
            <p>Entre em contato conosco: {{ config('mail.from.address') }}</p>
        </div>
    </div>
</body>

</html>
