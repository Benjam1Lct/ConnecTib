<?php

namespace App\Controllers;

use App\Models\ProcedureModel;

class SignUp extends BaseController
{
    private $procedureModel;

    public function __construct()
    {
        $this->procedureModel = new ProcedureModel();
    }

    public function signUp()
    {
        // Charger la page d'inscription
        return view('signup');
    }

    public function createAccount()
    {
        // Récupérer les données du formulaire
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm-password');

        // Vérifier que tous les champs sont remplis
        if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
            return redirect()->back()->with('error', 'Tous les champs sont obligatoires.')->withInput();
        }

        // Vérifier que les mots de passe correspondent
        if ($password !== $confirmPassword) {
            return redirect()->back()->with('error', 'Les mots de passe ne correspondent pas.')->withInput();
        }

        // Vérifier si l'email existe déjà
        $users = $this->procedureModel->getAllModel('Utilisateur');
        foreach ($users as $user) {
            if (strtolower($user['email']) === strtolower($email)) {
                return redirect()->back()->with('error', 'Cet email est déjà utilisé.')->withInput();
            }
        }

        try {
            // Ajouter l'utilisateur
            $paramsUser = [
                $name,                              // userNom
                $email,                             // userEmail
                password_hash($password, PASSWORD_DEFAULT), // userMdp
                '',                                 // userTelephone
                '',                                 // userAdresse
                'utilisateur',                      // userType
            ];
            $this->procedureModel->insertModel('Utilisateur', $paramsUser);

            // Récupérer l'utilisateur par email pour obtenir son ID
            $user = $this->procedureModel->getModelByEmail($email);
            
            if ($user) {
                $userId = $user->id_utilisateur;

                // Créer un panier pour l'utilisateur
                $paramsPanier = [
                    $userId,             // userId
                    0.00,                // totalPrice
                    date('Y-m-d H:i:s'), // creationDate
                ];
                $this->procedureModel->insertModel('Panier', $paramsPanier);
            }

            return redirect()->to('/signin')->with('success', 'Compte et panier créés avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la création du compte : ' . $e->getMessage())->withInput();
        }
    }
}
