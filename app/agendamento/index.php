<?php
include '../config/config.php';

if (isset($_ENV['bd_host_mysql'])) {
    header('Location: ../');
}
