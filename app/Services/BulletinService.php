<?php

namespace App\Services;

class BulletinService
{

    public static function getHeurSuppFerier($nbrHeur, $interv, $cout)
    {
        $taux = 0;
        if ($interv == '6-21') {
            $taux = 1.5;
        } else {
            $taux = 2;
        }
        return $nbrHeur * $cout * $taux;
    }
    public static function getHeurSuppOuvra($nbrHeur, $interv, $cout)
    {
        $taux = 0;
        if ($interv == '6-21') {
            $taux = 1.25;
        } else {
            $taux = 1.50;
        }
        return $nbrHeur * $cout * $taux;
    }
}
