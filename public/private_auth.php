<?php
session_name("Authentification");
session_start();

if (isset($_SESSION['auth']) && $_SESSION['auth'] === true){
    print("Vous etes venu ".++$_SESSION["nbr"]);
}
else{
    print("Vous n'avez pas le droit d'acceder à cette page !");
}