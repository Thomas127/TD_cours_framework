<?php

require_once __DIR__.'/../vendor/autoload.php';
define("EV_COURS_AFF", "cours.affiche");
use \Symfony\Component\EventDispatcher\EventDispatcher;
use \Symfony\Contracts\EventDispatcher\Event;

$dispatcher = new EventDispatcher();

$listener = function(){
    print "J'écoutele dispatcher\n";
};

class Bonjour{
    function affiche()
    {
        print("bonjour\n");
    }
}
$prio=10;
$i = new Bonjour();
$dispatcher->addListener(EV_COURS_AFF, $listener);
$dispatcher->addListener(EV_COURS_AFF, [$i,"affiche"],$prio);

$e = new Event();
$dispatcher->dispatch($e, EV_COURS_AFF);