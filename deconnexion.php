<?php
session_unset();
session_destroy();
flush();
header('Location: connexion.php');
