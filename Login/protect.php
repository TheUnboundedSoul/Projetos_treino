<?php
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['id'])) {
        die("Voce não pode acessar esta página, porque não está logado.<p><a href=\"\"> </p>");
    }
?>