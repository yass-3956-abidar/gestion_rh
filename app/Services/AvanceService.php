<?php

namespace App\Services;

class AvanceService
{


    public static function calculTotalAvane($avance)
    {
        $total = 0;
        foreach ($avance as $avance) {
            $total += $avance->montant;
        }
        return $total;
    }
}
