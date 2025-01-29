<?php
namespace App\Services;

interface StrategieLivraison {
    public function calculerCout($poids, $distance);
}