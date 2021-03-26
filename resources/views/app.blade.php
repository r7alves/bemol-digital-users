<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bemol - Cadastro Usuário </title>
    {{-- <title>Cadastro Usuário </title> --}}
    <link type="image/x-icon" rel="shortcut icon"
        href="https://d8xabijtzlaac.cloudfront.net/Custom/Content/Themes/Bemol/Imagens/favicon/bemol_icon.png">
    
        <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!-- Adicionando Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/util.js"></script>
</head>

    <body class="bg-light">
        @yield('content')
        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2021 - Bemol Digital</p>
        </footer>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        <script>
                (function () {
                    'use strict';

                    window.addEventListener('load', function () {
                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                        var forms = document.getElementsByClassName('needs-validation');

                        // Loop over them and prevent submission
                        var validation = Array.prototype.filter.call(forms, function (form) {
                            form.addEventListener('submit', function (event) {
                                if (form.checkValidity() === false) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                }
                                form.classList.add('was-validated');
                            }, false);
                        });
                    }, false);
                })();

                //mostrar campos pj    
            $( document ).ready(function() {
                var elemPJ = document.getElementById("camposPJ");
                elemPJ.style.display = "none";
                $('#camposPJ *').prop('required',false);
            });
            $("input:radio[name=tipo]").on("change", function () {   
                var elemPJ = document.getElementById("camposPJ");
                var elemPF = document.getElementById("camposPF");
                if($(this).val() == "pessoaFisica")
                {
                    elemPJ.style.display = "none";
                    $('#camposPJ *').prop('required',false);
                    elemPF.style.display = "";
                }
                else if($(this).val() == "pessoaJuridica")
                {
                    elemPF.style.display = "none";
                    $('#camposPF *').prop('required',false);;
                    elemPJ.style.display = "";
                }
            });
        </script>
    </body>
</html>