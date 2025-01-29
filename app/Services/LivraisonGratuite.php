<?php
namespace App\Services;

class LivraisonGratuite implements StrategieLivraison {
    public function calculerCout($poids, $distance) {
        return 0;
    }

    public function calculerDelay($distance) {
        return 10 + ($distance * 0.2);
    }
}