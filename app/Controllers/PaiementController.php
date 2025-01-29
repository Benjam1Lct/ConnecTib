<?php

namespace App\Controllers;

use App\Models\ProcedureModel;
use App\Entities\Paiement;

class PaiementController extends BaseController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ProcedureModel();
    }

    public function add()
    {
        return view('addPaiement');
    }

    public function addPaiement()
    {
        $paiement = new Paiement();
        $paiement->id_commande = $this->request->getPost('id_commande');
        $paiement->methodepaiement = $this->request->getPost('methodepaiement');
        $paiement->statut = $this->request->getPost('statut');

        try {
            $this->repository->insertModel('Paiement', [
                $paiement->id_commande,
                $paiement->methodepaiement,
                $paiement->statut,
            ]);
        } catch (\Exception $e) {
            // Handle error
        }

        return redirect()->to('/allPaiements');
    }

    public function allPaiements()
    {
        $paiements = $this->repository->getAllModel('Paiement', Paiement::class);
        return view('allPaiements', ['paiements' => $paiements]);
    }

    public function delete($id)
    {
        try {
            $this->repository->deleteModel('Paiement', [$id]);
        } catch (\Exception $e) {
            // Handle error
        }

        return redirect()->to('/allPaiements');
    }
}
