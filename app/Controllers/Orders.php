<?php

namespace App\Controllers;

use App\Models\ProcedureModel;
use App\Entities\Commande;
use App\Entities\CommandeProduit;
use App\Entities\Utilisateur;
use App\Entities\Produit;

class Orders extends BaseController
{

    private $repository;

    public function __construct()
    {
        $this->repository = new ProcedureModel(); // Utilisation du modèle basé sur les procédures stockées
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
        return view('allorders', ['userOrders' => $userOrders]);
    }

    public function detailsOrder()
    {
        $id_commande = $this->request->getPost('id_commande');
        $date = $this->request->getPost('date');
        $statut = $this->request->getPost('statut');
        $prixtotal = $this->request->getPost('prixtotal');

        $ordersProduit = $this->repository->getAllCommandProduit();
        $allProducts = $this->repository->getAllModel('Produit', Produit::class);

        $userOrders = [];
        foreach ($ordersProduit as $order) {
            // Si l'ID utilisateur correspond
            if ($order->id_commande == $id_commande) {
                // Retourner l'ID du panier
                $userOrders[] = $order;
            }
        }

        $listProduitDetail = [];
        foreach ($userOrders as $details) {
            $listProduitDetail[] = $details->id_produit;
        }
        
        $listeProduits = [];
        foreach ($listProduitDetail as $indexProduit) {
            foreach ($allProducts as $produits) {
                if ($produits->id_produit == $indexProduit) {
                    $listeProduits[] = $produits;
                }
            }
        }

        $size = count($listeProduits);

        return view('detailsorders', ['id_commande' => $id_commande, 'date' => $date, 'statut' => $statut, 'prixtotal' => $prixtotal,'size' => $size,'listeProduits' => $listeProduits]);
    }

}
