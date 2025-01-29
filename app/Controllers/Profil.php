<?php

namespace App\Controllers;

use App\Models\ProcedureModel;
use App\Entities\Commande;
use App\Entities\Utilisateur;
use App\Entities\Produit;

class Profil extends BaseController
{

    private $repository;

    public function __construct()
    {
        $this->repository = new ProcedureModel(); // Utilisation du modèle basé sur les procédures stockées
    } 

    public function profil(): string
    {
        $id_utilisateur = session()->get('user')['id']; // ID de l'utilisateur connecté
        $userInfos = $this->repository->getModel('UtilisateurById',[$id_utilisateur], Utilisateur::class);
        $allUsers = $this->repository->getAllModel('Utilisateur', Utilisateur::class);
        $userOrders = [];

        $orders = $this->repository->getAllModel('Commande', Commande::class);
        // Boucler à travers tous les paniers pour vérifier si l'ID utilisateur correspond
        foreach ($orders as $oder) {
            // Si l'ID utilisateur correspond
            if ($oder->id_utilisateur == $id_utilisateur) {
                // Retourner l'ID du panier
                $userOrders[] = $oder;
            }
        }

        $allProducts = $this->repository->getAllModel('Produit', Produit::class);

        return view('profil', ['orders' => $userOrders, 'userInfos' => $userInfos, 'allProducts' => $allProducts, 'allUsers' => $allUsers]);
    }

    public function updateDetails()
    {
        // Récupérer les données du formulaire
        $name = $this->request->getPost('name');
        $phone = $this->request->getPost('phone');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm-password');
        $adresse = $this->request->getPost('adresse');

        $id_utilisateur = session()->get('user')['id']; // ID de l'utilisateur connecté

        try {
            // Récupérer les informations actuelles de l'utilisateur
            $userInfo = $this->repository->getModel('UtilisateurById', [$id_utilisateur], Utilisateur::class);

            // Conditions de mise à jour
            $conditions = ['id_utilisateur' => $id_utilisateur];

            // Créer un tableau de données à mettre à jour
            $data = [
                'nom' => $name ?: $userInfo->nom, // Nom
                'telephone' => $phone ?: $userInfo->telephone, // Téléphone
                'adresse' => $adresse ?: $userInfo->adresse, // Adresse
            ];

            // Ajouter le mot de passe si fourni
            if (!empty($password)) {
                $data['mdp'] = password_hash($password, PASSWORD_DEFAULT);
            }

            // Mettre à jour les détails de l'utilisateur
            $this->repository->updateUserDetails('Utilisateur', $conditions, $data);

            // Mettre à jour le nom dans la session
            $updatedUserInfo = session()->get('user'); // Récupérer les infos de la session
            $updatedUserInfo['nom'] = $data['nom'];  // Mettre à jour le nom

            // Mettre à jour la session avec les nouvelles informations
            session()->set('user', $updatedUserInfo);

            return redirect()->to('/profil#Details')->with('success', 'Profil mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->to('/profil#Details')
                ->with('error', 'Erreur lors de la mise à jour du profil : ' . $e->getMessage())
                ->withInput();
        }
    }

    public function updateRole($id)
    {
        // Récupérer l'utilisateur actuel pour déterminer s'il doit être mis à jour
        $currentUserId = session()->get('user')['id']; // Type de l'utilisateur actuel dans la session

        if ($currentUserId == $id) {
            return redirect()->to('/profil#Users')->with('error', 'Vous ne pouvez pas modifier votre propre role.');
        }

        $userInfo = $this->repository->getModel('UtilisateurById', [$id], Utilisateur::class);

        // Déterminer le nouveau rôle basé sur l'utilisateur actuel
        $newRole = $userInfo->type_utilisateur === 'utilisateur' ? 'admin' : 'utilisateur';

        try {
            // Appeler la méthode pour mettre à jour le rôle dans la base de données
            $this->repository->updateUserRole('Utilisateur', $id, $newRole); // Utiliser la méthode précédente

            return redirect()->to('/profil#Users')->with('success', 'Rôle mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->to('/profil#Users')
                ->with('error', 'Erreur lors de la mise à jour du rôle : ' . $e->getMessage())
                ->withInput();
        }
    }

    public function allOrders()
    {
        $id_utilisateur = session()->get('user')['id']; // ID de l'utilisateur connecté
        $userOrders = [];

        $orders = $this->repository->getAllModel('Commande', Commande::class);
        // Boucler à travers tous les paniers pour vérifier si l'ID utilisateur correspond
        foreach ($orders as $oder) {
            // Si l'ID utilisateur correspond
            if ($oder->id_utilisateur == $id_utilisateur) {
                // Retourner l'ID du panier
                $userOrders[] = $oder;
            }
        }

        $allProducts = $this->repository->getAllModel('Produit', Produit::class);

        return view('profil', ['userOrders' => $userOrders]);
    }

}
