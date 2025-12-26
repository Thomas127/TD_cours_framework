<?php

if (isset($_SESSION['auth']) && $_SESSION['auth'] === true){
    print("Bienvenu ".++$_SESSION["login"]);
}
else{
    print("Vous n'avez pas le droit d'acceder à cette page !");
}