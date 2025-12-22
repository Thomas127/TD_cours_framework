<?php

session_name("Authentification");
session_start();

$_SESSION['auth'] = true;
$_SESSION['nbr'] = 0;

print("Bienvenu vous etes authentifié");