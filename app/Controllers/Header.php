<?php

namespace App\Controllers;

class Header extends BaseController

{
    public function index(): string
    {
        $procedureModel = new \App\Models\ProcedureModel();

        // Récupérer tous les produits
        $produits = $procedureModel->getAllModel('Produit', \App\Entities\Produit::class);

        // Vérifier qu'il y a au moins 3 produits
        $produit1 = $produits[count($produits) - 1] ?? null;
        $produit2 = $produits[count($produits) - 2] ?? null;
        $produit3 = $produits[count($produits) - 3] ?? null;

        // Passer les 3 produits séparément à la vue
        return [
            'produit1' => $produit1,
            'produit2' => $produit2,
            'produit3' => $produit3,
        ];
    }
}
