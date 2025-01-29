<?php
namespace App\Services;

use App\Entities\Commande;

class ConstructeurCommande {
    private $articles = [];
    private $prixtotal = 0;
    private $idUtilisateur;
    private $dateCommande;
    private $statut = 'En attente';

    public function definirUtilisateur($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
        return $this;
    }

    public function definirDate($date) {
        $this->dateCommande = $date;
        return $this;
    }

    public function ajouterArticle($produit) {
        $this->articles[] = $produit;
        return $this;
    }

    public function definirStatut($statut) {
        $this->statut = $statut;
        return $this;
    }

    public function definirPrixTotal($prixtotal) {
        $this->prixtotal = $prixtotal;
        return $this;
    }

    public function construire() {
        $totalPrice = array_reduce($this->articles, function ($sum, $article) {
            return $sum + ($article->prix * $article->quantite);
        }, 0);

        return new Commande([
            'id_utilisateur' => $this->idUtilisateur,
            'date' => $this->dateCommande,
            'statut' => $this->statut,
            'articles' => $this->articles,
            'prixtotal' => $totalPrice,
            'prixtotal' => $this->prixtotal,
        ]);
    }
}
