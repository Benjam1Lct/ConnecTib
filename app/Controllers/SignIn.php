<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Exceptions\DatabaseException;

class SignIn extends BaseController
{
    public function signIn()
    {
        // Charger la page Sign In
        return view('signin');
    }

    public function authenticate()
    {
        $db = \Config\Database::connect();

        // Récupérer les données du formulaire
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Vérification si les champs sont remplis
        if (empty($email) || empty($password)) {
            return redirect()->back()->with('error', 'Tous les champs sont obligatoires.')->withInput();
        }

        try {
            // Rechercher l'utilisateur par email avec une requête SQL directe
            $query = "SELECT * FROM Utilisateur WHERE email = ?";
            $result = $db->query($query, [$email])->getRow();

            if ($result) {
                // Vérification du mot de passe
                if (password_verify($password, $result->mdp)) {
                    // Stocker les informations de l'utilisateur en session
                    session()->set('user', [
                        'id' => $result->id_utilisateur,
                        'nom' => $result->nom,
                        'email' => $result->email,
                        'type' => $result->type_utilisateur,
                    ]);

                    return redirect()->to('/profil')->with('success', 'Connexion réussie.');
                } else {
                    return redirect()->back()->with('error', 'Mot de passe incorrect.')->withInput();
                }
            } else {
                return redirect()->back()->with('error', 'Aucun compte trouvé avec cet email.')->withInput();
            }
        } catch (DatabaseException $e) {
            return redirect()->back()->with('error', 'Erreur lors de la connexion : ' . $e->getMessage());
        }
    }

    public function logout()
    {
        // Détruire la session
        session()->destroy();
        return redirect()->to('/signin')->with('success', 'Déconnexion réussie.');
    }
}
