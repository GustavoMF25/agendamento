<?php
include "../config/config.php";
include "../config/conn.php";
include "../config/funcao.php";

$sqlQuery = "select 
                id,
                titulo ,
                datainicio,
                horainicio,
                datafim,
                horafim,
                importancia
            from agendamento where idsistema = {$_SESSION['idsistema']}";
$resp = mysqli_query($con, $sqlQuery);
$response = [];
$i = 0;
$rows = mysqli_num_rows($resp);

if ($rows > 0) {
    while ($row = mysqli_fetch_array($resp)) {
        $row[5] = $row[5] ? $row[5] : '23:59:59';
        $row[3] = $row[3] ? $row[3] : '00:00:00';
        $start = new DateTime($row[2] . ' ' . $row[3]);
        $end = new DateTime($row[4] . ' ' . $row[5]);

        print_r($end);
        $response[$i]["id"] = $row[0];
        $response[$i]["title"] = $row[1];

        $response[$i]["start"] = $row[3] ? $start->format('Y-m-d H:i:s') : $start->format('Y-m-d');
        $response[$i]["end"] = $row[5] ? $end->format('Y-m-d H:i:s') : $end->format('Y-m-d');
        $response[$i]["textColor"] = "#fafafa";
        switch ($row[6]) {
            case 3:
                $response[$i]["className"] = "event-danger";
                break;
            case 2:
                $response[$i]["className"] = "event-warning";
                break;
            case 1:
                $response[$i]["className"] = "event-basic";
                break;
        }
        $i++;
    }
}
?>
<!doctype html>
<html lang="pt-br">

<head>

    <meta charset="utf-8" />
    <title>Escolar | <?= isset($_SESSION['nomecliente']) ? $_SESSION['nomecliente'] : 'Syntax Web' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Gustavo Fernandes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= BASED ?>/assets/images/<?= isset($_SESSION['logo']) ? $_SESSION['logo'] : 'syntaxweb_logo.png' ?>">

    <!-- Select 2 -->
    <link href="<?= BASED ?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <!--RWD TABLE-->
    <link href="<?= BASED ?>/assets/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="<?= BASED ?>/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= BASED ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= BASED ?>/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!--DROPZONE-->
    <link href="<?= BASED ?>/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= BASEF ?>/vendor/assets/summernote/summernote-lite.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <style>

        a {
            color: inherit;
        }

        .event-basic {
            background-color: #0066ff !important;
            color: #fafafa !important;
        }

        .event-warning {
            background-color: #ffcc00 !important;
            color: #333 !important;
        }

        .event-danger {
            background-color: #ff1a1a !important;
            color: #fafafa !important;
        }

        .badge {
            padding: 5px !important;
        }
    </style>
</head>

<body data-sidebar="light" class="vertical-collpsed" data-layout-mode="light">

    <div class="spinner-wapper">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div id="layout-wrapper">
        <?php
        include "../include/navbar.php";
        include "../include/sidebarLeft.php";
        ?>

        <!-- CONTEUDO PRINCIPAL -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Escolar</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-grid">
                                                <button class="btn font-16 btn-primary" onclick="$('#event-modal').modal('show')" id="btn-new-event">
                                                    <i class="mdi mdi-plus-circle-outline"></i> Novo Evento
                                                </button>
                                            </div>

                                            <div class="row justify-content-center mt-5">
                                                <lottie-player src="<?= BASED ?>/assets/animation/escola-lottie.json" background="transparent" speed="1" style="width: 400px; height: 400px;" loop autoplay>
                                                </lottie-player>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col-->

                                <div class="col-lg-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="calendario"></div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->

                            </div>




                            <!-- Add New Event MODAL -->

                        </div>
                    </div>

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <div class="modal" id="modalDetalhes" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div id="cModalDetalhes" class="modal-content">
                        <div class="modal-header">
                            <h4 class="titile text-center">
                                Carregando...
                                <i class="fa fa-refresh fa-spin"></i>
                            </h4>
                        </div>
                        <div class="modal-footer"></div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © <a href="https://www.syntaxweb.com.br">SyntaxWeb</a>.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Desenvolvido pela <a href="https://www.syntaxweb.com.br">SyntaxWeb</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- FIM CONTEUDO PRINCIPAL -->
    </div>

    <script src="<?= BASED ?>/assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= BASED ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Select 2 -->
    <script src="<?= BASED ?>/assets/libs/select2/js/select2.min.js"></script>

    <!-- Calendar init -->
    <script src="<?= BASED ?>/assets/libs/moment/min/moment.min.js"></script>
    <script src="<?= BASED ?>/assets/libs/jquery-ui-dist/jquery-ui.min.js"></script>
    <!--RWD table-->
    <script src="<?= BASED ?>/assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>
    <script src="<?= BASED ?>/assets/libs/fullcalendar/dist/index.global.min.js"></script>
    <!-- JAVASCRIPT -->
    <script src="<?= BASED ?>/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= BASED ?>/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= BASED ?>/assets/libs/node-waves/waves.min.js"></script>
    <!-- plugin js -->
    <script src="<?= BASED ?>/include/funcao.js"></script>
    <script src="<?= BASEF ?>/assets/js/lottie-player.js"></script>
    <!-- Summernote -->
    <script src="<?= BASED ?>/assets/libs/summernote/summernote-bs4.min.js"></script>
    <!--DROPZONE-->
    <script src="<?= BASED ?>/assets/libs/dropzone/min/dropzone.min.js"></script>
    <!-- dashboard init -->
    <script src="<?= BASED ?>/assets/js/pages/dashboard.init.js"></script>
    <!-- App js -->
    <script src="<?= BASED ?>/assets/js/app.js"></script>
</body>

</html>