<?php

namespace App\Controllers;

use App\Models\ProcedureModel;
use App\Entities\Utilisateur;

class UtilisateurController extends BaseController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ProcedureModel();
    }

    public function add()
    {
        return view('addUtilisateur');
    }

    public function addUtilisateur()
    {
        $utilisateur = new Utilisateur();
        $utilisateur->nom = $this->request->getPost('nom');
        $utilisateur->email = $this->request->getPost('email');
        $utilisateur->mdp = $this->request->getPost('mdp');
        $utilisateur->telephone = $this->request->getPost('telephone');
        $utilisateur->adresse = $this->request->getPost('adresse');
        $utilisateur->type_utilisateur = $this->request->getPost('type_utilisateur');

        try {
            $this->repository->insertModel('Utilisateur', [
                $utilisateur->nom,
                $utilisateur->email,
                $utilisateur->mdp,
                $utilisateur->telephone,
                $utilisateur->adresse,
                $utilisateur->type_utilisateur,
            ]);
        } catch (\Exception $e) {
            // Handle error
        }

        return redirect()->to('/allUtilisateurs');
    }

    public function allUtilisateurs()
    {
        $utilisateurs = $this->repository->getAllModel('Utilisateur', Utilisateur::class);
        return view('allUtilisateurs', ['utilisateurs' => $utilisateurs]);
    }

    public function delete($id)
    {
        try {
            $this->repository->deleteModel('Utilisateur', [$id]);
        } catch (\Exception $e) {
            // Handle error
        }

        return redirect()->to('/allUtilisateurs');
    }
}
