<?php

namespace App\Controllers;

use App\Models\ProcedureModel;
use App\Entities\Produit;

class ProduitController extends BaseController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ProcedureModel(); // Utilisation du modèle basé sur les procédures stockées
    }

    // Affiche le formulaire pour ajouter un produit
    public function add()
    {
        return view('addproduct');
    }

    // Traite les données du formulaire et ajoute un produit
    public function addProduct()
    {
        $produit = new Produit();
        $produit->nom = $this->request->getPost('nom');
        $produit->categorie = $this->request->getPost('categorie');
        $produit->description = $this->request->getPost('description');
        $produit->prix = floatval($this->request->getPost('prix'));
        $produit->stock = intval($this->request->getPost('stock'));
        $produit->img_path = $this->request->getPost('img_path');

        try {
            $this->repository->insertModel('Produit', [
                $produit->nom,
                $produit->categorie,
                $produit->description,
                $produit->prix,
                $produit->stock,
                $produit->img_path
            ]);
            $message = "Produit ajouté avec succès.";
        } catch (\Exception $e) {
            $message = "Erreur lors de l’ajout du produit : " . $e->getMessage();
        }

        return redirect()->to('/products/add')->with('success', 'Produit ajouté avec succès.');
    }

    // Affiche un produit spécifique
    public function display(array $params)
    {
        $id = intval($params[0]);
        $produit = $this->repository->getModel('Produit', [$id], Produit::class);
        require "app/Views/displayProduct.php";
    }

    // Affiche le formulaire de modification pour un produit spécifique
    public function update($id)
    {
        $id = intval($id); // Convertir l'identifiant en entier
        $produit = $this->repository->getModel('ProduitById', [$id], Produit::class);
        return view('updateProduct', ['products' => $produit]);
    }

    // Traite les données du formulaire de modification et met à jour le produit
    public function updateProduct()
    {
        $id = intval($this->request->getPost('id'));
        $produit = new Produit();
        $produit->nom = $this->request->getPost('nom');
        $produit->categorie = $this->request->getPost('categorie');
        $produit->description = $this->request->getPost('description');
        $produit->prix = floatval($this->request->getPost('prix'));
        $produit->stock = intval($this->request->getPost('stock'));
        $produit->img_path = $this->request->getPost('img_path');

        try {
            $this->repository->updateModel('Produit', [
                $id,
                $produit->nom,
                $produit->categorie,
                $produit->description,
                $produit->prix,
                $produit->stock,
                $produit->img_path
            ]);
            $message = "Produit mis à jour avec succès.";
        } catch (\Exception $e) {
            $message = "Erreur lors de la mise à jour du produit : " . $e->getMessage();
        }

        return redirect()->to('/allProducts')->with('success', 'Produit mis à jour avec succès.');
    }

    // Supprime un produit
    public function delete($id)
{
    $id = intval($id); // Convertir l'identifiant en entier

    try {
        $this->repository->deleteModel('Produit', [$id]); // Suppression via le modèle
        $message = "Produit supprimé avec succès.";
    } catch (\Exception $e) {
        $message = "Erreur lors de la suppression du produit : " . $e->getMessage();
    }
    return redirect()->to('/allProducts')->with('success', 'Produit supprimé avec succès.');
}


    // Affiche tous les produits
    public function products()
    {
        $products = $this->repository->getAllModel('Produit', Produit::class);

        $allCategorie = [];
        foreach ($products as $product) {
            // Si l'ID utilisateur correspond
            if (!in_array($product->categorie, $allCategorie)) {
                // Retourner l'ID du panier
                $allCategorie[] = $product->categorie;
            }
        }
        return view('products', ['products' => $products, 'allCategorie' => $allCategorie]);
    }

    public function allProducts()
    {
        $products = $this->repository->getAllModel('Produit', Produit::class);
        return view('alllproduits', ['products' => $products]);
    }

    public function productDetail($id)
    {
        $id = intval($id); // Convertir l'identifiant en entier

    // Récupérer le produit en fonction de l'ID
    $product = $this->repository->getModel('ProduitById', [$id], Produit::class);

    // Retourner la vue avec le produit
    return view('productdetail', ['product' => $product]);
    }

}
