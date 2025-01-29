<?php

namespace App\Controllers;

use App\Models\ProcedureModel;

class Cart extends BaseController
{
    private $procedureModel;

    public function __construct()
    {
        $this->procedureModel = new ProcedureModel();
    }

    // Affiche le contenu du panier
    public function cart(): string
    {

        try {
            // Récupérer l'ID de l'utilisateur connecté
            $userId = session()->get('user')['id'];

            if (!$userId) {
                return redirect()->to('/signin')->with('error', 'Veuillez vous connecter pour voir votre panier.');
            }
            
            $paniers = $this->procedureModel->getAllModel('Panier', \App\Entities\Panier::class);
            $panierId = 0;
            $totalPrice = 0;

            // Boucler à travers tous les paniers pour vérifier si l'ID utilisateur correspond
            foreach ($paniers as $panier) {
                // Si l'ID utilisateur correspond
                if ($panier->id_utilisateur == $userId) {
                    // Retourner l'ID du panier
                    $panierId = $panier->id_panier;
                    $totalPrice = $panier->prixtotal;
                }
            }

            $userPanierProduits = []; 

            $panierproduits  = $this->procedureModel->getAllModel('PanierProduit', \App\Entities\PanierProduit::class);
            // Boucler à travers tous les paniers pour vérifier si l'ID utilisateur correspond
            foreach ($panierproduits as $produit) {
                // Si l'ID utilisateur correspond
                if ($produit->id_panier == $panierId) {
                    // Retourner l'ID du panier
                    $userPanierProduits[] = $produit;
                }
            }

            // Récupérer les objets Produits associés aux produits du panier
            $allProductDetails = [];
            foreach ($userPanierProduits as $produit) {
                $productDetails = $this->procedureModel->getModel('ProduitById', [$produit->id_produit], \App\Entities\Produit::class);
                $allProductDetails[] = $productDetails;
            }
            
            $cartSize = count($userPanierProduits);
            $userPanierProduitsSave = $userPanierProduits;


            return view('cart', [
                'panierProducts' => $userPanierProduitsSave, 
                'allProductsDetails' => $allProductDetails,
                'cartSize' => $cartSize,
                'totalPrice' => $totalPrice
            ]);  
        } catch (\Exception $e) {
            $userPanierProduitsSave = [];
            $allProductDetails = [];
            $cartSize = 0;
            $totalPrice = 0;
            
            return view('cart', [
                'panierProducts' => $userPanierProduitsSave, 
                'allProductsDetails' => $allProductDetails,
                'cartSize' => $cartSize,
                'totalPrice' => $totalPrice
            ]);
        }
          
    }

    // Ajouter un produit au panier
    public function add()
    {
        try {
            $userId = session()->get('user')['id'];

            if (!$userId) {
                return redirect()->to('/signin')->with('error', 'Veuillez vous connecter pour ajouter un produit au panier.');
            }
            $productId = $this->request->getPost('id_produit');
            $quantite = $this->request->getPost('quantity');
            $prix = $this->request->getPost('prix');
            echo($quantite);

            if (empty($productId) || empty($quantite) || $quantite < 1) {
                return redirect()->back()->with('error', $quantite);
            }
            $this->procedureModel->insertModel('PanierProduit', [
                $userId,
                $productId,
                $quantite,
                $prix * $quantite
            ]);


            $totalPrix = 0;
            $panierId = 0;

            $paniers = $this->procedureModel->getAllModel('Panier', \App\Entities\Panier::class);

            // Boucler à travers tous les paniers pour vérifier si l'ID utilisateur correspond
            foreach ($paniers as $panier) {
                // Si l'ID utilisateur correspond
                if ($panier->id_utilisateur == $userId) {
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

            $date = (new \DateTime())->format('Y-m-d H:i:s');

            // Mettre à jour le prix total dans la table Panier
            $this->procedureModel->updateModel('Panier', [$userId,$totalPrix,$date]);

            return redirect()->back()->with('success', 'Ajouté au panier');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout au panier : ' . 'Vouqs devez être connecter pour ajouter un produit au panier');
        }
    }

    // Modifier la quantité d'un produit dans le panier
    public function update()
    {
        $userId = session()->get('user')['id'];

        if (!$userId) {
            return redirect()->to('/signin')->with('error', 'Veuillez vous connecter pour modifier un produit dans votre panier.');
        }

        $productId = $this->request->getPost('product_id');
        $quantite = $this->request->getPost('quantity');
        $prix = $this->request->getPost('prix');

        if (empty($productId) || empty($quantite) || $quantite < 1) {
            return redirect()->back()->with('error', 'Quantité invalide.');
        }

        try {
            $this->procedureModel->updateModel('PanierProduit', [
                $userId,
                $productId,
                $quantite,
                $prix * $quantite
            ]);

            return redirect()->to('/cart')->with('success', 'Quantité mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour du produit : ' . $e->getMessage());
        }
    }

    // Supprimer un produit du panier
    public function delete($productId)
    {
        $userId = session()->get('user')['id'];

        if (!$userId) {
            return redirect()->to('/signin')->with('error', 'Veuillez vous connecter pour supprimer un produit de votre panier.');
        }

        if (empty($productId)) {
            return redirect()->back()->with('error', 'Produit invalide.');
        }

        try {
            $this->procedureModel->deleteModel('PanierProduit', [$productId]);

            $totalPrix = 0;
            $panierId = 0;

            $paniers = $this->procedureModel->getAllModel('Panier', \App\Entities\Panier::class);

            // Boucler à travers tous les paniers pour vérifier si l'ID utilisateur correspond
            foreach ($paniers as $panier) {
                // Si l'ID utilisateur correspond
                if ($panier->id_utilisateur == $userId) {
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

            $date = (new \DateTime())->format('Y-m-d H:i:s');

            // Mettre à jour le prix total dans la table Panier
            $this->procedureModel->updateModel('Panier', [$userId,$totalPrix,$date]);

            return redirect()->to('/cart')->with('success', 'Produit supprimé du panier.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la suppression du produit : ' . $e->getMessage());
        }
    }
}
