<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Produit extends Entity
{
    protected $attributes = [
        'id_produit'   => null,
        'nom'          => null,
        'categorie'    => null,
        'description'  => null,
        'prix'         => null,
        'stock'        => null,
        'img_path'     => null,
    ];
}
