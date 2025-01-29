<?php

namespace App\Controllers;

use App\Models\ProcedureModel; 

use App\Services\ContexteLivraison;
use App\Services\LivraisonStandard;
use App\Services\LivraisonExpress;
use App\Services\LivraisonGratuite;

class Checkout extends BaseController
{
    private $procedureModel;

    public function __construct()
    {
        $this->procedureModel = new ProcedureModel();
    }

    public function checkout()
    {
        $id_utilisateur = session()->get('user')['id']; // ID de l'utilisateur connecté

        $totalPrix = 0;
        $panierId = 0;

        $paniers = $this->procedureModel->getAllModel('Panier', \App\Entities\Panier::class);

        // Boucler à travers tous les paniers pour vérifier si l'ID utilisateur correspond
        foreach ($paniers as $panier) {
            // Si l'ID utilisateur correspond
            if ($panier->id_utilisateur == $id_utilisateur) {
                // Retourner l'ID du panier
                $panierId = $panier->id_panier;
            }
        }

        $panierproduits  = $this->procedureModel->getAllModel('PanierProduit', \App\Entities\PanierProduit::class);
        // Boucler à travers tous les paniers pour vérifier si l'ID utilisateur correspond
        foreach ($panierproduits as $produit) {
            // Si l'ID utilisateur correspond
            if ($produit->id_panier == $panierId) {
                // Retourner l'ID du panier
                $totalPrix = $totalPrix + $produit->prix;
            }
        }
        $selectedType = $this->request->getPost('type_livraison') ?? 'standard';

        switch ($selectedType) {
            case 'express':
                $strategie = new LivraisonExpress();
                break;
            case 'gratuite':
                $strategie = new LivraisonGratuite();
                break;
            default:
                $strategie = new LivraisonStandard();
        }

        $pourcentage = 0.2;  // 20 % exprimé en décimal (0,2)

        // Calculer le coût avec la stratégie sélectionnée
        $contexte = new ContexteLivraison($strategie);
        $livraisonCout = $contexte->calculerCout(5,20);
        $deliveryDelai = $contexte->calculerDelay(20);

        $totalPrixHT = $totalPrix * (1 - $pourcentage);
        $TVA = $totalPrix * $pourcentage;

        // Ajouter les frais de livraison au total
        $totalPrix += $livraisonCout;



        // Passer les données à la vue
        return view('checkout', ['totalPrice' => $totalPrix, 'TVA' => $TVA, 'totalPrixHT' => $totalPrixHT ,'livraisonCout' => $livraisonCout,'deliveryDelai' => $deliveryDelai , 'selectedType' => $selectedType]);
    }
}
