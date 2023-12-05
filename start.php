<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Primeiro passo | Syntax Web </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="GustavoFernandes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="images/syntaxweb_logo.png">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/libs/toastr/build/toastr.min.css">

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            let install = false;
            let idSistema = null;
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "500",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            $("#instalation-steep").steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "slide",
                labels: {
                    next: "Próximo",
                    previous: "Anterior",
                    finish: "Concluir"
                },
                onStepChanging: function(event, currentIndex, newIndex) {
                    if (install) {
                        return true
                    } else {
                        toastr.warning("Realize a instalação.")
                        return false
                    }
                },
                onFinishing: function(event, currentIndex) {
                    console.log('Finalizado')
                    window.location = '/agendamento'
                },
            });

            $("#criarBD").click(() => {
                let host = $("#host-bd").val();
                let user = $("#user-bd").val();
                let pass = $("#pass-bd").val();
                let url = "install/bd.php";
                if (host && user) {
                    $.ajax({
                        url: url,
                        dataType: 'json',
                        type: 'POST',
                        data: {
                            host,
                            user,
                            pass
                        }
                    }).done(function(resp) {
                        if (resp.response) {
                            install = true
                            toastr.success(resp.msg)
                        } else {
                            toastr.warning(resp.msg)
                        }
                    }).fail((err) => {
                        toastr.error(err.responseText)
                    })
                } else {
                    toastr.error('Preencha as informações necessárias')
                }
            })

            $("#btn-form-sistema").click((e) => {
                e.preventDefault();
                let form = $("#form-sistema")[0];
                let dados = new FormData(form);


                $.ajax({
                    url: 'install/sistema.php',
                    dataType: 'json',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: dados,

                    success: function(resp) {
                        console.log(resp.res)
                        // Tratar a resposta do servidor
                        if (resp.response) {
                            toastr.success(resp.msg)
                            idSistema = resp.idSistema
                        } else {
                            toastr.warning(resp.msg)
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            })

            $("#btn-form-usuario").click((e) => {
                e.preventDefault();
                if (idSistema) {
                    let form = $("#form-usuario")[0];
                    let dados = new FormData(form);
                    dados.append("idsistemas", idSistema)
                    $.ajax({
                        url: 'install/usuario.php',
                        dataType: 'json',
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: dados,

                        success: function(resp) {
                            console.log(resp.res)
                            if (resp.response) {
                                toastr.success(resp.msg)
                            } else {
                                toastr.warning(resp.msg)
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });

                } else {
                    toastr.warning("Primeiramente faça o cadastro do sistema.")
                }
            })

        });
    </script>
</head>

<body>
    <div class="home-btn d-none d-sm-block">
        <a href="index.html" class="text-white"><i class="fas fa-home h2"></i></a>
    </div>

    <div class="my-5 pt-sm-5">
        <div class="container">
            <div class="card">

                <div class="card-body">
                    <h4 class="card-title mb-4">
                        <img src="images/syntaxweb_logo.png" alt="" class="rounded-circle mx-2" height="30">
                        Instalação e Configuração
                    </h4>

                    <div id="instalation-steep">
                        <!-- Seller Details -->
                        <h3>Instalação</h3>
                        <section>

                            <div class="row">
                                <div class="col-lg-12" id="install-bd">
                                    <p><strong>Prezado usuário,</strong></p>

                                    <p>Agradecemos por escolher nosso sistema para atender às suas necessidades. Para garantir que você desfrute de todas as funcionalidades e benefícios oferecidos, é crucial realizar a instalação adequada.</p>

                                    <p>Por favor, siga as instruções abaixo para concluir o processo de instalação:</p>

                                    <ol>
                                        <li><strong>Localize o Botão "Instalar":</strong> Ao abrir o assistente de instalação, observe a presença do botão identificado como "Instalar". Ele geralmente estará destacado e posicionado de forma proeminente na tela.</li>
                                        <li><strong>Inclua as informações do Banco de dados:</strong> Para que a aplicação funcione é necessário que você preencha as informações do seu banco de dados, tais como: <strong>Host</strong>, <strong>User</strong> & <strong>Password</strong>.</li>
                                        <li><strong>Clique em "Instalar":</strong> Com o botão identificado, clique sobre ele para iniciar o processo de instalação. Isso dará início à transferência e configuração dos arquivos necessários para o funcionamento adequado do sistema.</li>
                                        <li><strong>Aguarde a Conclusão:</strong> Dependendo da velocidade de sua conexão com a internet e das especificações do seu dispositivo, o processo de instalação pode levar alguns minutos. Recomendamos paciência durante esse período.</li>
                                        <li><strong>Siga as Instruções Adicionais (se houver):</strong> Em alguns casos, poderá ser necessário fornecer informações adicionais ou configurar preferências específicas. Caso isso ocorra, siga as instruções fornecidas na tela.</li>
                                        <li><strong>Verifique a Conclusão da Instalação:</strong> Ao término do processo, você deverá receber uma notificação indicando que a instalação foi concluída com sucesso. Certifique-se de verificar se não há mensagens de erro.</li>
                                        <li><strong>Clique em Proximo:</strong> Para dar continuidade no processo de instalação e configuração aperte no botão <strong>Próximo</strong>.</li>
                                    </ol>

                                    <p>Pronto! Agora você está pronto para explorar todas as funcionalidades do nosso sistema. Em caso de dúvidas ou problemas durante a instalação, consulte a seção de suporte técnico em nosso site ou entre em contato com nossa equipe de atendimento ao cliente.</p>

                                    <p>Agradecemos por sua escolha e esperamos que tenha uma experiência excelente com nosso sistema.</p>

                                    <p><em>Atenciosamente,<br>

                                            Syntax Web</em></p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="option-date">Host</span>
                                            <input type="text" class="form-control" name="host" id="host-bd" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="option-date">User</span>
                                            <input type="text" class="form-control" name="user" id="user-bd" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="option-date">Password</span>
                                            <input type="text" class="form-control" name="password" id="pass-bd" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button id="criarBD" class="btn btn-success">Instalar</button>
                                </div>
                            </div>



                        </section>
                        <h3>Cadastro do sistema</h3>
                        <section>
                            <div>
                                <h5>Cadastro de Sistema: Preencha os Campos</h5>

                                <p>Bem-vindo ao cadastro! Preencha os campos com informações precisas:</p>

                                <ul>
                                    <li><strong>Nome:</strong> Insira o nome do sistema.</li>
                                    <li><strong>Telefone:</strong> Informe seu número para contato.</li>
                                    <li><strong>E-mail:</strong> Forneça um e-mail válido.</li>
                                    <li><strong>Foto:</strong> Adicione uma foto para seu sistema.</li>
                                </ul>
                            </div>
                            <form method="post" id="form-sistema" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Nome do sistema</label>
                                            <input type="text" name="nome-sistema" class="form-control" require id="basicpill-firstname-input" placeholder="Nome do Sistema">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-phoneno-input">Telefone</label>
                                            <input type="text" class="form-control" name="telefone" id="basicpill-phoneno-input" placeholder="Telefone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="basicpill-lastname-input">Email Principal</label>
                                            <input type="email" class="form-control" name="email" require id="basicpill-email-input" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mt-4">
                                            <div>
                                                <label for="formFileSm" class="form-label">Small file input example</label>
                                                <input class="form-control form-control-sm" name="foto" id="formFileSm" type="file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <button id="btn-form-sistema" class="btn btn-success">Cadastrar</button>
                                </div>
                            </form>
                        </section>

                        <!-- Company Document -->
                        <h3>Criando usuario</h3>
                        <section>
                            <div>
                                <h5>Cadastro de Usuario: Preencha os Campos solicitados</h5>

                                <p>Bem-vindo ao cadastro! Preencha os campos com informações precisas:</p>

                            </div>
                            <form id="form-usuario" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" id="nome" name="nome" required placeholder="Nome">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="login">Login</label>
                                            <input type="text" class="form-control" id="login" name="login" required placeholder="Login">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="senha">Senha</label>
                                            <input type="password" class="form-control" id="senha" name="senha" required placeholder="Senha">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="fotoUsuario">Foto de Perfil</label>
                                            <input class="form-control form-control-sm" name="foto" id="fotoUsuario" type="file">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="fotoUsuario">Data de Nascimento</label>
                                            <div class="input-group" id="datepicker1">
                                                <input type="text" class="form-control" name="datanascimento" placeholder="dd M, yyyy" data-date-format="yyyy-m-d" data-date-container="#datepicker1" data-provide="datepicker">

                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <button id="btn-form-usuario" class="btn btn-success">Cadastrar</button>
                                </div>
                            </form>
                        </section>

                        <!-- Confirm Details -->
                        <h3>Finalizando</h3>
                        <section>
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="text-center">
                                        <div class="mb-4">
                                            <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                        </div>
                                        <div>
                                            <h5>Confirm Detail</h5>
                                            <p class="text-muted">If several languages coalesce, the grammar of the resulting</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="text-center">
                        <em>Todas as informações são confidenciais. Em caso de dúvidas, entre em contato conosco. Agradecemos por escolher nosso sistema!</em>
                    </div>
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <!--<script src="assets/js/lottie-player.js.min.js"></script>-->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!-- Plugins js -->
    <!-- jquery step -->
    <script src="assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="assets/libs/toastr/build/toastr.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/@chenfengyuan/datepicker/datepicker.min.js"></script>
    <!-- JAVASCRIPT -->
    <!-- form wizard init -->
    <script src="assets/js/pages/form-wizard.init.js"></script>

    <script src="assets/js/app.js"></script>

</body>

</html>