<?php
include './login/conn.php';

$sqlVerifica = "select count(*) from sistema";
$respVer = mysqli_query($con, $sqlVerifica);
$response = mysqli_fetch_array($respVer)[0];
if ($response == 0) {
    header('location: start.php');
}


?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <title>Login | Calendário </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="GustavoFernandes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="images/syntaxweb_logo.png">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Seja Bem vindo Calendário</h5>

                                        <?php
                                        if (!isset($_GET['msg'])) {
                                        ?>
                                            <p>Realizar o login</p>
                                        <?php
                                        } else {
                                        ?>
                                            <span style="color: red;">
                                                <p><?= $_GET['msg'] ?></p>
                                            </span>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <!--<img src="assets/images/profile-img.png" alt="" class="img-fluid">-->
                                    <lottie-player src="./animacoes/119593-agenda.json" background="transparent" speed="1" style="width: 150px;" loop autoplay></lottie-player>

                                    <!--Alterar essa imagem para uma animação-->
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="auth-logo">
                                <a href="index-2.html" class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="images/syntaxweb_logo.png" alt="" class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>

                                <a href="index-2.html" class="auth-logo-dark">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="images/syntaxweb_logo.png" alt="" class="rounded-circle" height="60">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                <form class="form-horizontal" method="post" action="./login/verLogin.php">

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Usuario</label>
                                        <input type="text" class="form-control" name="login" id="username" placeholder="Enter username">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Senha</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" name="senha" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                            <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>
                                    <div class="mt-3 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Logar</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock me-1"></i> Esqueceu sua senha ?</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">

                        <div>
                            <p>©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Calendário. Created by <a href="https://www.syntaxweb.com.br">SyntaxWeb</a>
                            </p>
                        </div>
                    </div>

                </div>
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


    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>