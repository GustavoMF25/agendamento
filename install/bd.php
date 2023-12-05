<?php

try {
    $host = $_POST['host'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $comando_composer = 'composer install';
    $resultado = shell_exec($comando_composer);

    $conAll = mysqli_connect($host, $user, $pass, '');
    if ($conAll) {
        $createSchema = "create schema if not exists syntaxweb_agendamento";
        if (mysqli_query($conAll, $createSchema)) {

            //grava os dados do host no .env
            $variaveis = "bd_host_mysql = $host \n";
            $variaveis .= "bd_user_mysql = $user \n";
            $variaveis .= "bd_schema_mysql = syntaxweb_agendamento \n";
            $variaveis .= "bd_password_mysql = $pass \n\n";

            file_put_contents('../config/.env', $variaveis);
            $con = mysqli_connect($host, $user, $pass, 'syntaxweb_agendamento');

            $sqlCreateTableSistema = "
                CREATE TABLE if not exists `syntaxweb_agendamento`.`sistema` (
                    `id` int auto_increment PRIMARY KEY,
                    `idplano` int,
                    `nomecliente` varchar(255) unique, 
                    `emailcliente` varchar(255) unique,
                    `logo` varchar(255),
                    `telefone` varchar(255),
                    `ativo` enum('s','n'),
                    `datager` date,
                    `horager` time
                ) ENGINE=InnoDB";

            $sqlCreateTableLogerro = "
                CREATE TABLE if not exists `syntaxweb_agendamento`.`logerro` (
                    `idlogerro` int auto_increment PRIMARY KEY,
                    `tabela` varchar(255),
                    `idtabela` int,
                    `acao` varchar(255),
                    `descricao` varchar(255),
                    `modulo` varchar(255),
                    `arquivo` varchar(255),
                    `datager` date,
                    `horager` time
                ) ENGINE=InnoDB";

            $sqlCreateTableUsuario = "
                CREATE TABLE if not exists `syntaxweb_agendamento`.`usuario` (
                    `id` int(11) auto_increment PRIMARY KEY,
                    `idsistema`  int,
                    `nome` varchar(255),
                    `login` varchar(255) unique,
                    `senha` varchar(255),
                    `email` varchar(255) unique,
                    `foto`varchar(255),
                    `datanascimento` date,
                    `created_at` datetime,
                    `updated_at` datetime,
                    `status` ENUM('a','i')
                ) ENGINE=InnoDB";

            $sqlCreateTableIpUsuario = "
                CREATE TABLE if not exists `syntaxweb_agendamento`.`ipusuario` (
                    `id` int auto_increment PRIMARY KEY,
                    `idusuario` int,
                    `ip` varchar(255),
                    `nomedispositivo` varchar(45),
                    `token` varchar(255),
                    `status` enum('p','l','b'),
                    `datager` date,
                    `horager` time
                ) ENGINE=InnoDB; ";
            $sqlCreateTableAgendamento = "
                                
                CREATE TABLE if not exists `syntaxweb_agendamento`.`agendamento` (
                    `id` int(11) auto_increment PRIMARY KEY,
                    `idusuario` int(11),
                    `idsistema` int(11),
                    `titulo` varchar(255),
                    `importancia` enum('1','2','3'),
                    `url` varchar(255),
                    `descricao` text,
                    `datainicio` date,
                    `datafim` date,
                    `horainicio` time,
                    `horafim` time,
                    `diatodo` enum('0','1')
                ) ENGINE=InnoDB;";
            $sqlCreateTableAlterUsuario = "
                ALTER TABLE `syntaxweb_agendamento`.`usuario` ADD FOREIGN KEY(`idsistema`) REFERENCES `syntaxweb_agendamento`.`sistema` (id)
        ";
            $sqlCreateTableAlterAgendamento = "
                ALTER TABLE `syntaxweb_agendamento`.`agendamento` ADD FOREIGN KEY(`idsistema`) REFERENCES `syntaxweb_agendamento`.`sistema` (id);
        ";


            $stmtSistema = mysqli_prepare($con, $sqlCreateTableSistema);
            $stmtUsuario = mysqli_prepare($con, $sqlCreateTableUsuario);
            $stmtLogerro = mysqli_prepare($con, $sqlCreateTableLogerro);
            $stmtIpUsuario = mysqli_prepare($con, $sqlCreateTableIpUsuario);
            $stmtAgendamento = mysqli_prepare($con, $sqlCreateTableAgendamento);
            $stmtAlterUsuario = mysqli_prepare($con, $sqlCreateTableAlterUsuario);
            $stmtAlterAgendamento = mysqli_prepare($con, $sqlCreateTableAlterAgendamento);

            if ($stmtSistema && $stmtUsuario && $stmtLogerro && $stmtIpUsuario && $stmtAgendamento && $stmtAlterUsuario && $stmtAlterAgendamento) {
                mysqli_stmt_execute($stmtSistema);
                mysqli_stmt_execute($stmtUsuario);
                mysqli_stmt_execute($stmtLogerro);
                mysqli_stmt_execute($stmtIpUsuario);
                mysqli_stmt_execute($stmtAgendamento);
                mysqli_stmt_execute($stmtAlterUsuario);
                mysqli_stmt_execute($stmtAlterAgendamento);
                echo json_encode(['response' => true, "msg" => "Sistema instalado com sucesso!"]);
            } else {
                throw new Exception("Erro na preparação da consulta: " . mysqli_error($conexao));
            }
        } else {
            echo json_encode(['response' => false, "msg" => "Falha ao criar o sistema!"]);
        }
    } else {
        echo json_encode(['response' => false, "msg" => "Falha ao criar o bando de dados!"]);
    }

} catch (Exception $e) {
    echo json_encode(['response' => false, "msg" => "Ocorreu uma falha na instalação, por favor entre em contato com o administrador do sistema!", "erro" =>  $e->getMessage()]);
}
