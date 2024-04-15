<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$subject}} </title>

    <style>
        body{
            max-width: 670px;
            padding: 10px;
            margin: 20px auto;
        }

       body p{
            color: lightslategray;  
            font-size: clamp(15px, calc(15px + 0.6vw),22px); 
            text-align: start;
        }
        body p span{
            font-weight: bold;
        }
        body p span.token{
            color:darkred;
        }
        body a.link-call-center-page{
            color: #1E90FF;
        }
    </style>
</head>
<body>
    <header>HEADER</header>
  <div class="body">
  <p>Olá, <span>{{$name}}</span> !</p>
    <p>Seu código é: <span class="token">{{$token}}</span></p>
    <p>Caso tenha algum problema entre em contato conosco através de nossa central de atendimento: 
        <a class="link-call-center-page" href="{{config('app.call_center_page')}}">{{config('app.call_center_page')}}</a>
    </p>
    <p>Equipe {{config('app.name')}}</p>
  </div>
  <footer>FOOTER</footer>
</body>
</html>