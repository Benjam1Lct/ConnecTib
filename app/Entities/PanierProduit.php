<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PanierProduit extends Entity
{
    protected $attributes = [
        'id_pan_prod'  => null,
        'id_panier'    => null,
        'id_produit'   => null,
        'quantité'     => null,
        'prix'         => null,
    ];
}
