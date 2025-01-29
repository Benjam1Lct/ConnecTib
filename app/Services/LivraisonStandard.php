<?php
namespace App\Services;

class LivraisonStandard implements StrategieLivraison {
    public function calculerCout($poids, $distance) {
        return 5 + ($poids * 0.5) + ($distance * 0.1);
    }

    public function calculerDelay($distance) {
        return 10 ;
    }
}