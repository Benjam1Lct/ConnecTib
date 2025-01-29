<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Paiement extends Entity
{
    protected $attributes = [
        'id_paiement'      => null,
        'id_commande'      => null,
        'methodepaiement'  => null,
        'statut'           => null,
        'date'             => null,
    ];
}
