<?php
namespace App\Services;

class LivraisonExpress implements StrategieLivraison {
    public function calculerCout($poids, $distance) {
        return 10 + ($poids * 0.8) + ($distance * 0.2);
    }

    public function calculerDelay($distance) {
        return 10 - ($distance * 0.2);
    }
}