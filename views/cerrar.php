<?php

session_start();
session_destroy();

//Redireccionamiento
header('Location: ../index.php');


?>