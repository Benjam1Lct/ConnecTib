<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Commande extends Entity
{
    protected $attributes = [
        'id_commande'  => null,
        'id_utilisateur' => null,
        'date'         => null,
        'statut'       => null,
        'prixtotal'    => null,
    ];
}
