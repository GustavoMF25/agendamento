<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <span class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?= BASED ?>/assets/images/<?= isset($_SESSION['logo']) ? $_SESSION['logo'] : 'syntaxweb_logo.png' ?>" alt="" height="32"> 
                    </span>
                    <span class="logo-lg">
                        <img src="<?= BASED ?>/assets/images/<?= isset($_SESSION['logo']) ? $_SESSION['logo'] : 'syntaxweb_logo.png' ?>" alt="" height="37"> 
                        <strong><?=$_SESSION['nomecliente']?></strong>
                    </span>
                </span>

                <span class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?= BASED ?>/assets/images/<?= isset($_SESSION['logo']) ? $_SESSION['logo'] : 'syntaxweb_logo.png' ?>" alt="" height="32">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= BASED ?>/assets/images/<?= isset($_SESSION['logo']) ? $_SESSION['logo'] : 'syntaxweb_logo.png' ?>" alt="" height="39"> 
                    </span>
                </span>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <div class="m-t-10 m-l-25 d-flex align-items-center">
                <span>
                    <?php
                    // $_SESSION['nomesobrenome']
                    $nome = $_SESSION['nomesobrenome'];
                    $hr = date("H");
                    if ($hr >= 12 && $hr < 18) {
                        $resp = "Olá <b>{$nome}</b>, boa tarde! Bem vindo ao <strong> Calendário!</strong>";
                    } else if ($hr >= 0 && $hr < 12) {
                        $resp = "Olá <b>{$nome}</b>, bom dia! Bem vindo ao <strong> Calendário!</strong>";
                    } else {
                        $resp = "Olá <b>{$nome}</b>, boa noite! Bem vindo ao Calendário!";
                    }
                    echo "$resp";
                    ?>
                </span>
            </div>
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?= BASED ?>/assets/images/<?= isset($_SESSION['foto']) ? $_SESSION['foto'] : 'users/avatar-1.jpg' ?>" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?= $_SESSION['nomesobrenome'] ?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <span class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#modalConfig"><i class="bx bx-wrench font-size-16 align-middle me-1"></i>Configurar</span>
                    <a class="dropdown-item text-danger" href="<?= BASED ?>/sair.php"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>

                </div>
            </div>
        </div>
    </div>
</header>

<div class="modal" id="modalConfig" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div id="cModalConfig" class="modal-content">
            <div class="modal-header">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" title="Usuarios">
                        <a class="nav-link active" data-bs-toggle="tab" href="#usuarios" role="tab" aria-selected="true">
                            <span class="d-block d-sm-none"><i class="bx bx-id-card"></i></span>
                            <span class="d-none d-sm-block"><i class="bx bx-id-card"></i> Usuarios</span>
                        </a>
                    </li>
                </ul>
                <div>aaa</div>
            </div>
            <div class="modal-body">
                <div class="tab-content p-2 text-muted">
                    <div class="tab-pane active" id="usuarios" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <span onclick="mudaTabUsuario('lista')"><i class="bx bx-list-ol " data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" title="Lista de usuarios"></i></span>
                            </div>
                            <div class="d-flex font-18 justify-content-end col-sm-12 col-md-6 col-lg-6">
                                <span onclick="mudaTabUsuario('criar')"><i class="bx bx-user-plus" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" title="Criar usuario"></i></span>
                            </div>
                        </div>
                        <div id="listaUsuario" style="display: none;">
                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                <table class="table table-small-font table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <!--<th>#</th>-->
                                            <th style="text-align: center;">#</th>
                                            <th style="text-align: center;">Nome</th>
                                            <th style="text-align: center;">Login</th>
                                            <th style="text-align: center;">Email</th>
                                            <th style="text-align: center;">Data de Nascimento</th>
                                            <th style="text-align: center;">Ação</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sqlUser = "select 
                                                        id,
                                                        nome,
                                                        login,
                                                        email,
                                                        datanascimento ,
                                                        foto
                                                    from usuario
                                                    where idsistema = {$_SESSION['idsistema']}";
                                        if ($respUser = mysqli_query($con, $sqlUser)) {
                                            while ($row = mysqli_fetch_array($respUser)) {
                                        ?>
                                                <tr>
                                                    <!--<td class="text-nowrap"><b>#<?= $row[0] ?></b></td>-->
                                                    <td class="text-nowrap">
                                                        <img style="border-radius: 50%;" src="<?= BASED ?>/assets/images/users/<?= isset($row[5]) ? $row[5] : 'avatar-1.jpg' ?>" alt="" height="32">
                                                    </td>
                                                    <td class="text-nowrap"><?= $row[1] ?></td>
                                                    <td class="text-nowrap"><?= $row[2] ?></td>
                                                    <td class="text-nowrap"><?= $row[3] ?></td>
                                                    <td class="text-nowrap"><?= dataBuscaBanco($row[4]) ?></td>
                                                    <td class="text-nowrap" onclick='editarUsuario(<?= $row[0] ?>);' data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" title="Editar usuario">
                                                        <i class="bx bx-pencil"></i>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "Sem usuarios encontrados";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="editUser" style="display: none;">

                        </div>

                        <div id="criarUsuario" style="display: none;">
                            <div class="d-flex justify-content-center">
                                <h5>Criação de usuarios</h5>
                            </div>

                            <form method="post" action="<?= BASED ?>/usuario/include/gUsuario.php" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nome-usuario" class="form-label">Nome</label>
                                            <input type="text" class="form-control" id="nome-usuario" name="nome" placeholder="Digite o nome do usuario">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="login" class="form-label">Login</label>
                                            <div class="input-group">
                                                <div class="input-group-text">@</div>
                                                <input type="text" class="form-control" name="login" id="login" placeholder="Login">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email-usuario" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email_usuario" id="email-usuario" placeholder="Digite o E-mail do usuario">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nascimento" class="form-label">Data de Nascimento</label>
                                            <input id="nascimento" name="nascimento" required class="form-control" type="date" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="senha" class="form-label">Senha</label>
                                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a senha do Usuario">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="confirma-senha" class="form-label">Confirmar Senha</label>
                                            <input type="password" onchange="confirmaSenha()" name="confirma_senha" class="form-control" id="confirma-senha" placeholder="Digite a senha novamente">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary w-md">Cadastrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>