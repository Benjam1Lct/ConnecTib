<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Panier extends Entity
{
    protected $attributes = [
        'id_panier'    => null,
        'id_utilisateur' => null,
        'date'         => null,
        'prixtotal'    => null,
    ];
}
