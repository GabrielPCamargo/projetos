<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Margareth</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <style>
        body {
            height: 100vh;
            font-family: 'Roboto', sans-serif;
        }

        .quadro{
            width: fit-content;
            padding: 1em;
            border-radius: 2em;
        }

        h2 {
            cursor: pointer;
        }

        i{
            font-size: 7em;
            color: red;
        }
    </style>
</head>
<body class="bg-info d-flex justify-content-center align-items-center">
    <div class="text-center bg-light quadro">
        <p>Hoje é o seu dia, o dia da pessoa que me trouxe ao mundo.</p>
        <p>Pessoa que me ensinou muitas coisas.</p>
        <p>E que eu posso chamar de mãe!</p>
        <p>Obrigado por ser essa pessoa incrível e estar sempre por perto.</br>
        E por ter dedicado muitas vezes o seu tempo à mim.</p>
        <p>Acredito que o melhor presente é estarmos juntos, mas depois tu escolhe teu presente mesmo.</p>
        <p> &#128514  &#128514  &#128514</p>
        <p>Desculpa por as vezes não ter o devido respeito com você</p>
        <p>Mas queria que você soubesse que é a melhor mãe do mundo!</p>
        <h2>Feliz dia das mães</h2>
        <h2 class="amo">Te amo mãe!</h2>
        <i class="fas fa-heart d-none"></i>
    </div>

    <script>
        const i = document.querySelector('.fa-heart');
        const h2 = document.querySelector('.amo');

        h2.addEventListener('click', () => {
            i.className = 'fas fa-heart';
        })
    </script>

</body>
</html>