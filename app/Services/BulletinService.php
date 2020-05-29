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
    public static function calculAncienter($dateEmbauche, $salaire, $heureSup)
    {
        $durre = self::calculDuree($dateEmbauche);
        $taux = self::getTaux($durre);
        return $montantPrimeAncienter = ($salaire + $heureSup) * $taux / 100;
    }

    public static function calculDuree($dateEmbauche)
    {
        $dateNow = date_create(date('yy/m/d'));
        $dateEmbauche = date_create($dateEmbauche);
        $interval = date_diff($dateNow, $dateEmbauche);
        return $interval->format('%y');
    }
    public static function getTaux($durre)
    {
        $taux = 0;

        if ($durre >= 25) {
            $taux = 25;
        } elseif ($durre >= 20) {
            $taux = 20;
        } elseif ($durre >= 12) {
            $taux = 15;
        } elseif ($durre >= 5) {
            $taux = 10;
        } elseif ($durre >= 2) {
            $taux = 5;
        }
        return $taux;
    }
}
