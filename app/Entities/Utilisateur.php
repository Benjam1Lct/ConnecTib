<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Utilisateur extends Entity
{
    protected $attributes = [
        'id_utilisateur'    => null,
        'nom'               => null,
        'email'             => null,
        'mdp'               => null,
        'telephone'         => null,
        'adresse'           => null,
        'type_utilisateur'  => null,
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function setMdp(string $password): self
    {
        $this->attributes['mdp'] = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->attributes['mdp']);
    }

    public function isAdmin(): bool
    {
        return $this->attributes['type_utilisateur'] === 'admin';
    }

    public function isValidEmail(): bool
    {
        return filter_var($this->attributes['email'], FILTER_VALIDATE_EMAIL) !== false;
    }
}
