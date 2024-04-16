<!DOCTYPE html>
<html lang=pt-BR>

<head>
    <title>Bem-vindo à MyStore !</title>
    <style>
        /* Estilos CSS para o e-mail */
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

            opacity: 0.8;
            max-width: 670px;
            width: 100%;
            margin: 20px auto;
        }

        .container-email {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .content {
            padding: 20px 0;
        }

        .content .btn-link {
            padding: 6px 10px;
            background-color: darkred;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
        }

        .footer {
            text-align: center;
            padding-top: 20px;
            color: #888;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container-email">
        <div class="header">
            <h1>Bem-vindo à {{ $app_name}}</h1>
        </div>
        <div class="content">
            <p>Prezado(a) <strong>{{ $name ?? 'Cliente' }}</strong>,</p>
            <h3>Seja muito bem-vindo(a) à nossa loja! É um prazer tê-lo(a) como parte da nossa comunidade de clientes.</h3>
            <p>Estamos animados por você ter escolhido a nossa loja para suas necessidades de compras online.</p>
            <p>1. <strong>Produtos de Qualidade:</strong> Oferecemos uma ampla variedade de produtos de alta qualidade
                para atender às suas necessidades.</p>
            <p>2. <strong>Atendimento ao Cliente Excepcional:</strong> Nossa equipe de suporte está pronta para ajudar
                no que for necessário.</p>
            <p>3. <strong>Promoções e Novidades:</strong> Esteja sempre atualizado(a) sobre nossas últimas promoções e
                novidades.</p>
            <p>Aproveite para explorar nosso site e descobrir todos os produtos incríveis que temos para oferecer. Para
                começar a navegar</p>
            <a class="btn-link" href={{ config('app.client') }} target="_blank">Ir para a Loja</a>
            <p>Agradecemos por escolher a nossa loja e estamos à disposição para ajudá-lo(a) em sua jornada de compras
                online.</p>
        </div>
        <div class="footer">
            <p>Atenciosamente,<br>{{ $app_name }}</p>
            <p>Entre em contato conosco: {{ $contact }}</p>
        </div>
    </div>
</body>

</html>