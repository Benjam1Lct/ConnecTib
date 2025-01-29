<?php

namespace App\Controllers;

use App\Models\ProcedureModel;
use App\Entities\Panier;

class PanierController extends BaseController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ProcedureModel();
    }

    public function add()
    {
        return view('addPanier');
    }

    public function addPanier()
    {
        $panier = new Panier();
        $panier->id_utilisateur = $this->request->getPost('id_utilisateur');
        $panier->prixtotal = $this->request->getPost('prixtotal');

        try {
            $this->repository->insertModel('Panier', [
                $panier->id_utilisateur,
                $panier->prixtotal,
            ]);
        } catch (\Exception $e) {
            // Handle error
        }

        return redirect()->to('/allPaniers');
    }

    public function allPaniers()
    {
        $paniers = $this->repository->getAllModel('Panier', Panier::class);
        return view('allPaniers', ['paniers' => $paniers]);
    }

    public function delete($id)
    {
        try {
            $this->repository->deleteModel('Panier', [$id]);
        } catch (\Exception $e) {
            // Handle error
        }

        return redirect()->to('/allPaniers');
    }
}
