<?php

namespace App\Services;

class BulletinService
{

    public static function getHeurSuppFerier($nbrHeur, $interv, $cout)
    {
        $taux = self::getTaucHeurFerier($interv);
        return $nbrHeur * $cout * $taux;
    }
    public static function getHeurSuppOuvra($nbrHeur, $interv, $cout)
    {
        $taux = self::getTaucHeurOuv($interv);

        return $nbrHeur * $cout * $taux;
    }
    public static function getTaucHeurOuv($interv)
    {
        $taux = 0;
        if ($interv == '6-21') {
            $taux = 1.25;
        } else {
            $taux = 1.50;
        }
        return $taux;
    }
    public static function getTaucHeurFerier($interv)
    {
        $taux = 0;
        if ($interv == '6-21') {
            $taux = 1.5;
        } else {
            $taux = 2;
        }
        return $taux;
    }
    public static function calculAncienter($dateEmbauche, $salaire, $heureSup)
    {
        $durre = self::calculDuree($dateEmbauche);
        $taux = self::getTaux($durre);
        return ($salaire + $heureSup) * $taux / 100;
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
    public static function CotisCnss($sbi)
    {
        // plafond 268.80
        $cotiCnss = $sbi * 4.48 / 100;
        if ($cotiCnss > 268.80) {
            $cotiCnss = 268.80;
        }
        return $cotiCnss;
    }
    public static function cotisICmr($tuaxIcmr, $sbi)
    {
        $cotiIcmr = ($sbi) * $tuaxIcmr / 100;
        return $cotiIcmr;
    }
    public static function fraisPersonnlle($sbi, $avantage)
    {
        $friaProfesio = ($sbi - $avantage) * 20 / 100;
        return $friaProfesio;
    }
    public static function getAMO($sbi)
    {
        $cotisAmo = $sbi * 2.26 / 100;
        return $cotisAmo;
    }
    //     0-2500	0%	0
    // 2501-4166,66 	10%	250 Dh
    // 4166,67-5000 	20%	666,67
    // 5001-6666,666	30%	1166,67
    // 6666,67-15000	34%	1433,33
    // +15000	        38% 2033,33
    public static function gettauxIr($sni)
    {
        $taux = 0;
        $sommeAdeduire = 0;
        $tabVal = [];
        if ($sni >= 15000) {
            $taux = 38;
            $sommeAdeduire = 2033.33;
        } elseif ($sni >= 6666.67) {
            $taux = 34;
            $sommeAdeduire = 1433.33;
        } elseif ($sni >= 5001) {
            $taux = 30;
            $sommeAdeduire = 1166.67;
        } elseif ($sni >= 4166.67) {
            $taux = 20;
            $sommeAdeduire = 666.67;
        } elseif ($sni >= 2501) {
            $taux = 10;
            $sommeAdeduire = 250;
        }
        $tabVal["taux"] = $taux;
        $tabVal["sommeAdeduire"] = $sommeAdeduire;
        return $tabVal;
    }
    public static function getIrBrute($sni)
    {
        $tabVal = self::gettauxIr($sni);
        $irBurte = ($sni * $tabVal["taux"]) / 100 - $tabVal["sommeAdeduire"];
        return $irBurte;
    }
    public  static function getChargeFamille($nbr)
    {
        $charge = $nbr * 30;
        if ($charge > 180) {
            $charge = 180;
        }
        return $charge;
    }
    public static  function getIntervalJo($taux)
    {
        $interval = '';
        switch ($taux) {
            case 25:
                $interval = "6-21";
                break;
            case 50:
                $interval = "21-6";
                break;
        }
        return $interval;
    }
    public static  function getIntervalJF($taux)
    {
        $interval = '';
        switch ($taux) {
            case 50:
                $interval = "6-21";
                break;
            case 100:
                $interval = "21-6";
                break;
        }
        return $interval;
    }
}
