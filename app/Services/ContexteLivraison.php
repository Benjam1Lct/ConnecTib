<?php
namespace App\Services;

class ContexteLivraison {
    private $strategie;

    public function __construct(StrategieLivraison $strategie) {
        $this->strategie = $strategie;
    }

    public function definirStrategie(StrategieLivraison $strategie) {
        $this->strategie = $strategie;
    }

    public function calculerCout($poids, $distance) {
        return $this->strategie->calculerCout($poids, $distance);
    }

    public function calculerDelay($distance) {
        return $this->strategie->calculerDelay($distance);
    }
}