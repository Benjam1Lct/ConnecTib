<?php

namespace App\Controllers;

use App\Models\ProcedureModel;
use App\Entities\Commande;
use App\Entities\Paiement;
use App\Entities\PanierProduit;
use App\Services\ConstructeurCommande;


class CommandeController extends BaseController
{
    private $procedureModel;

    public function __construct()
    {
        $this->procedureModel = new ProcedureModel();
    }

    public function createCommande()
    {
        $id_utilisateur = session()->get('user')['id'];
        $payment_method = $this->request->getPost('payment-method');
        $totalPrice = $this->request->getPost('totalPrice');

        try {
            // Récupérer les produits du panier
            $paniers = $this->procedureModel->getAllModel('Panier', \App\Entities\Panier::class);
            $panierId = 0;
            foreach ($paniers as $panier) {
                if ($panier->id_utilisateur == $id_utilisateur) {
                    $panierId = $panier->id_panier;
                }
            }

            $panierProduits = $this->procedureModel->getAllModel('PanierProduit', \App\Entities\PanierProduit::class);
            $commandeProduits = [];
            foreach ($panierProduits as $produit) {
                if ($produit->id_panier == $panierId) {
                    $commandeProduits[] = $produit;
                }
            }

            if (empty($commandeProduits)) {
                return redirect()->back()->with('error', 'Votre panier est vide.');
            }

            // Utiliser le Builder Pattern pour construire la commande
            $constructeur = new ConstructeurCommande();
            $constructeur->definirUtilisateur($id_utilisateur)
                ->definirDate(date('Y-m-d H:i:s'))
                ->definirStatut('En attente')
                ->definirPrixTotal($totalPrice);

            foreach ($commandeProduits as $produit) {
                $constructeur->ajouterArticle($produit);
            }

            $commande = $constructeur->construire();

            // Sauvegarder la commande
            $this->procedureModel->insertQuery('Commande', [
                'id_utilisateur' => $commande->id_utilisateur,
                'date' => $commande->date,
                'statut' => $commande->statut,
                'prixtotal' => $commande->prixtotal,
            ]);

            $commande_id = $this->procedureModel->getLastInsertId();

            // Ajouter les produits de la commande
            foreach ($commandeProduits as $produit) {
                $this->procedureModel->insertQuery('CommandeProduit', [
                    'id_commande' => $commande_id,
                    'id_produit' => $produit->id_produit,
                    'quantite' => $produit->quantite,
                    'prix' => $produit->prix,
                ]);
            }

            // Enregistrer le paiement
            $this->procedureModel->insertQuery('Paiement', [
                'id_commande' => $commande_id,
                'methodepaiement' => $payment_method,
                'statut' => 'Effectué',
                'date' => date('Y-m-d H:i:s'),
            ]);

            // Vider le panier
            foreach ($commandeProduits as $produit) {
                $this->procedureModel->deleteQuery('PanierProduit', ['id_pan_prod' => $produit->id_pan_prod]);
            }
            $this->procedureModel->updateQuery('Panier', ['prixtotal' => 0], ['id_panier' => $panierId]);

            return redirect()->to('/confirmation')->with('success', 'Order placed successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la création de la commande : ' . $e->getMessage());
        }
    }

    public function confirmation()
    {
        return view('confirmation', [
            'message' => session()->getFlashdata('success'),
        ]);
    }
}