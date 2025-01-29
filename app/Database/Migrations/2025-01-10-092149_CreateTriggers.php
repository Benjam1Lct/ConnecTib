<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTriggers extends Migration
{
    public function up()
    {
        // Vérifier le stock avant d'ajouter au Panier
        $this->db->query("
            CREATE TRIGGER BeforeInsertPanierProduit
            BEFORE INSERT ON PanierProduit
            FOR EACH ROW
            BEGIN
                DECLARE current_stock INT;
                SELECT stock INTO current_stock
                FROM Produit
                WHERE id_produit = NEW.id_produit;

                IF current_stock < NEW.quantite THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Stock insuffisant pour ce produit.';
                END IF;
            END;
        ");

        // Supprimer les dépendances liées à un Panier
        $this->db->query("
            CREATE TRIGGER AfterDeletePanier
            AFTER DELETE ON Panier
            FOR EACH ROW
            BEGIN
                DELETE FROM PanierProduit WHERE id_Panier = OLD.id_Panier;
            END;
        ");

        // Supprimer les dépendances d'une Commande lors de sa suppression
        $this->db->query("
            CREATE TRIGGER AfterDeleteCommande
            AFTER DELETE ON Commande
            FOR EACH ROW
            BEGIN
                DELETE FROM CommandeProduit WHERE id_Commande = OLD.id_Commande;
                DELETE FROM Paiement WHERE id_Commande = OLD.id_Commande;
            END;
        ");

        // Mettre à jour le statut de la Commande après un Paiement
        $this->db->query("
            CREATE TRIGGER AfterInsertPaiement
            AFTER INSERT ON Paiement
            FOR EACH ROW
            BEGIN
                UPDATE Commande
                SET statut = 'Payée'
                WHERE id_Commande = NEW.id_Commande;
            END;
        ");

        // Gérer les dépendances liées à un utilisateur lors de sa suppression
        $this->db->query("
            CREATE TRIGGER AfterDeleteUtilisateur
            AFTER DELETE ON Utilisateur
            FOR EACH ROW
            BEGIN
                DELETE FROM Panier WHERE id_utilisateur = OLD.id_utilisateur;
                DELETE FROM Commande WHERE id_utilisateur = OLD.id_utilisateur;
                DELETE FROM CommandeProduit
                WHERE id_Commande IN (
                    SELECT id_Commande FROM Commande WHERE id_utilisateur = OLD.id_utilisateur
                );
                DELETE FROM Paiement
                WHERE id_Commande IN (
                    SELECT id_Commande FROM Commande WHERE id_utilisateur = OLD.id_utilisateur
                );
            END;
        ");

        // Gérer les dépendances d'un produit lors de sa suppression
        $this->db->query("
            CREATE TRIGGER AfterDeleteProduit
            AFTER DELETE ON Produit
            FOR EACH ROW
            BEGIN
                DELETE FROM CommandeProduit WHERE id_produit = OLD.id_produit;
                DELETE FROM PanierProduit WHERE id_produit = OLD.id_produit;
            END;
        ");

        // Vérifier que le prix total d'un Panier est correct avant insertion
        $this->db->query("
            CREATE TRIGGER BeforeInsertPanier
            BEFORE INSERT ON Panier
            FOR EACH ROW
            BEGIN
                DECLARE calculated_price DECIMAL(10,2);
                SELECT SUM(prix * quantite) INTO calculated_price
                FROM PanierProduit
                WHERE id_Panier = NEW.id_Panier;

                IF NEW.prixtotal != calculated_price THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Le prix total ne correspond pas à la somme des produits.';
                END IF;
            END;
        ");

        // Mettre à jour le prix total du Panier après modification des produits associés
        $this->db->query("
            CREATE TRIGGER AfterUpdatePanierProduit
            AFTER UPDATE ON PanierProduit
            FOR EACH ROW
            BEGIN
                DECLARE new_total DECIMAL(10,2);
                SELECT SUM(prix * quantite) INTO new_total
                FROM PanierProduit
                WHERE id_Panier = NEW.id_Panier;

                UPDATE Panier
                SET prixtotal = new_total
                WHERE id_Panier = NEW.id_Panier;
            END;
        ");

        // Vérifier que le prix total d'une Commande est correct avant insertion
        $this->db->query("
            CREATE TRIGGER BeforeInsertCommande
            BEFORE INSERT ON Commande
            FOR EACH ROW
            BEGIN
                DECLARE calculated_price DECIMAL(10,2);
                SELECT SUM(prix * quantite) INTO calculated_price
                FROM CommandeProduit
                WHERE id_Commande = NEW.id_Commande;

                IF NEW.prixtotal != calculated_price THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Le prix total ne correspond pas à la somme des produits.';
                END IF;
            END;
        ");

        // Mettre à jour le prix total de la Commande après modification des produits associés
        $this->db->query("
            CREATE TRIGGER AfterUpdateCommandeProduit
            AFTER UPDATE ON CommandeProduit
            FOR EACH ROW
            BEGIN
                DECLARE new_total DECIMAL(10,2);
                SELECT SUM(prix * quantite) INTO new_total
                FROM CommandeProduit
                WHERE id_Commande = NEW.id_Commande;

                UPDATE Commande
                SET prixtotal = new_total
                WHERE id_Commande = NEW.id_Commande;
            END;
        ");

        // Vérifier que le stock reste positif après mise à jour directe dans Produit
        $this->db->query("
            CREATE TRIGGER BeforeUpdateProduit
            BEFORE UPDATE ON Produit
            FOR EACH ROW
            BEGIN
                IF NEW.stock < 0 THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Le stock ne peut pas être négatif.';
                END IF;
            END;
        ");
    }

    public function down()
    {
        $this->db->query("DROP TRIGGER IF EXISTS BeforeInsertPanierProduit");
        $this->db->query("DROP TRIGGER IF EXISTS BeforeInsertCommande");
        $this->db->query("DROP TRIGGER IF EXISTS AfterUpdateCommandeProduit");
        $this->db->query("DROP TRIGGER IF EXISTS BeforeInsertPanier");
        $this->db->query("DROP TRIGGER IF EXISTS AfterUpdatePanierProduit");
        $this->db->query("DROP TRIGGER IF EXISTS AfterDeleteCommande");
        $this->db->query("DROP TRIGGER IF EXISTS AfterDeletePanier");
        $this->db->query("DROP TRIGGER IF EXISTS AfterDeleteUtilisateur");
        $this->db->query("DROP TRIGGER IF EXISTS AfterDeleteProduit");
        $this->db->query("DROP TRIGGER IF EXISTS BeforeUpdateProduit");
        $this->db->query("DROP TRIGGER IF EXISTS AfterInsertPaiement");
    }
}
