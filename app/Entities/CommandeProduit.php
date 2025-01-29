<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class CommandeProduit extends Entity
{
    protected $attributes = [
        'id_details'   => null,
        'id_commande'  => null,
        'id_produit'   => null,
        'quantité'     => null,
        'prix'         => null,
    ];
}
