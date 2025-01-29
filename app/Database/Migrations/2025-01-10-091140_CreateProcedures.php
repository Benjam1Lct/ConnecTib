<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProcedures extends Migration
{
    public function up()
    {
        // Procédures pour la table Utilisateur
        $this->db->query("
            CREATE PROCEDURE InsertUtilisateur(
                IN userNom VARCHAR(255),
                IN userEmail VARCHAR(255),
                IN userMdp VARCHAR(255),
                IN userTelephone VARCHAR(20),
                IN userAdresse VARCHAR(255),
                IN userType VARCHAR(50)
            )
            BEGIN
                INSERT INTO Utilisateur (nom, email, mdp, telephone, adresse, type_utilisateur)
                VALUES (userNom, userEmail, userMdp, userTelephone, userAdresse, userType);
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE UpdateUtilisateur(
                IN userId INT,
                IN userNom VARCHAR(255),
                IN userEmail VARCHAR(255),
                IN userMdp VARCHAR(255),
                IN userTelephone VARCHAR(20),
                IN userAdresse VARCHAR(255),
                IN userType VARCHAR(50)
            )
            BEGIN
                UPDATE Utilisateur
                SET nom = userNom, email = userEmail, mdp = userMdp,
                    telephone = userTelephone, adresse = userAdresse, type_utilisateur = userType
                WHERE id_utilisateur = userId;
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE DeleteUtilisateur(IN userId INT)
            BEGIN
                DELETE FROM Utilisateur WHERE id_utilisateur = userId;
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE GetUtilisateurById(IN userId INT)
            BEGIN
                SELECT * FROM Utilisateur WHERE id_utilisateur = userId;
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE GetAllUtilisateur()
            BEGIN
                SELECT * FROM Utilisateur;
            END;
        ");

        // Procédures pour la table Produit
        $this->db->query("
            CREATE PROCEDURE InsertProduit(
                IN prodNom VARCHAR(255),
                IN prodCategorie VARCHAR(255),
                IN prodDescription TEXT,
                IN prodPrix DECIMAL(10,2),
                IN prodStock INT,
                IN prodImg_path VARCHAR(255)
            )
            BEGIN
                INSERT INTO Produit (nom, categorie, description, prix, stock, img_path)
                VALUES (prodNom, prodCategorie, prodDescription, prodPrix, prodStock, prodImg_path);
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE UpdateProduit(
                IN prodId INT,
                IN prodNom VARCHAR(255),
                IN prodCategorie VARCHAR(255),
                IN prodDescription TEXT,
                IN prodPrix DECIMAL(10,2),
                IN prodStock INT,
                IN prodImg_path VARCHAR(255)
            )
            BEGIN
                UPDATE Produit
                SET nom = prodNom, categorie = prodCategorie, description = prodDescription,
                    prix = prodPrix, stock = prodStock, img_path = prodImg_path
                WHERE id_produit = prodId;
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE DeleteProduit(IN prodId INT)
            BEGIN
                DELETE FROM Produit WHERE id_produit = prodId;
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE GetProduitById(IN prodId INT)
            BEGIN
                SELECT * FROM Produit WHERE id_produit = prodId;
            END;
        ");

        $this->db->query("
        CREATE PROCEDURE GetAllProduit()
        BEGIN
            SELECT * FROM Produit;
        END;
        ");

        // Procédures pour la table Commande
        $this->db->query("
            CREATE PROCEDURE InsertCommande(
                IN userId INT,
                IN totalPrice DECIMAL(10,2)
            )
            BEGIN
                INSERT INTO COMMANDE (id_utilisateur, prixtotal, statut, date)
                VALUES (userId, totalPrice, 'En attente', NOW());
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE UpdateCommande(
                IN commandeId INT,
                IN newStatus VARCHAR(50),
                IN newTotalPrice DECIMAL(10,2)
            )
            BEGIN
                UPDATE COMMANDE
                SET statut = newStatus, prixtotal = newTotalPrice
                WHERE id_commande = commandeId;
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE DeleteCommande(IN commandeId INT)
            BEGIN
                DELETE FROM COMMANDE WHERE id_commande = commandeId;
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE GetAllCommande()
            BEGIN
                SELECT * FROM Commande;
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE GetCommandeById(IN commandeId INT)
            BEGIN
                SELECT * FROM COMMANDE WHERE id_commande = commandeId;
            END;
        ");

        // Procédures pour la table CommandeProduit
        $this->db->query("
            CREATE PROCEDURE InsertCommandeProduit(
                IN commandeId INT,
                IN produitId INT,
                IN quantity INT,
                IN price DECIMAL(10,2)
            )
            BEGIN
                INSERT INTO CommandeProduit (id_commande, id_produit, quantité, prix)
                VALUES (commandeId, produitId, quantity, price);
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE UpdateCommandeProduit(
                IN commandeProduitId INT,
                IN newQuantity INT,
                IN newPrice DECIMAL(10,2)
            )
            BEGIN
                UPDATE CommandeProduit
                SET quantité = newQuantity, prix = newPrice
                WHERE id_details = commandeProduitId;
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE DeleteCommandeProduit(IN commandeProduitId INT)
            BEGIN
                DELETE FROM CommandeProduit WHERE id_details = commandeProduitId;
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE GetCommandeProduits(IN commandeId INT)
            BEGIN
                SELECT * FROM CommandeProduit WHERE id_commande = commandeId;
            END;
        ");

        // Procédures pour la table PanierProduit
        $this->db->query("
            CREATE PROCEDURE InsertPanierProduit(
                IN panierId INT,
                IN produitId INT,
                IN quantite INT,
                IN price DECIMAL(10,2)
            )
            BEGIN
                INSERT INTO PanierProduit (id_panier, id_produit, quantite, prix)
                VALUES (panierId, produitId, quantite, price);
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE UpdatePanierProduit(
                IN panierProduitId INT,
                IN newQuantity INT,
                IN newPrice DECIMAL(10,2)
            )
            BEGIN
                UPDATE PanierProduit
                SET quantité = newQuantity, prix = newPrice
                WHERE id_pan_prod = panierProduitId;
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE DeletePanierProduit(IN panierProduitId INT)
            BEGIN
                DELETE FROM PanierProduit WHERE id_pan_prod = panierProduitId;
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE GetPanierProduits(IN panierId INT)
            BEGIN
                SELECT * FROM PanierProduit WHERE id_panier = panierId;
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE GetAllPanierProduit()
            BEGIN
                SELECT * FROM PanierProduit;
            END;
        ");

        // Procédures pour la table Panier
        $this->db->query("
            CREATE PROCEDURE InsertPanier(
                IN userId INT,
                IN totalPrice DECIMAL(10,2),
                IN creationDate DATETIME
            )
            BEGIN
                INSERT INTO Panier (id_utilisateur, prixtotal, date)
                VALUES (userId, totalPrice, creationDate);
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE UpdatePanier(
                IN panierId INT,
                IN newTotalPrice DECIMAL(10,2),
                IN updateDate DATETIME
            )
            BEGIN
                UPDATE Panier
                SET prixtotal = newTotalPrice, date = updateDate
                WHERE id_panier = panierId;
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE DeletePanier(IN panierId INT)
            BEGIN
                DELETE FROM Panier WHERE id_panier = panierId;
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE GetPanierById(IN panierId INT)
            BEGIN
                SELECT * FROM Panier WHERE id_panier = panierId;
            END;
        ");

        $this->db->query("
            CREATE PROCEDURE GetAllPanier()
            BEGIN
                SELECT * FROM Panier;
            END;
        ");
    }

    public function down()
    {
        // Suppression des procédures
        $procedures = [
            'InsertUtilisateur', 'UpdateUtilisateur', 'DeleteUtilisateur', 'GetUtilisateurById', 'GetAllUtilisateur',
            'InsertProduit', 'UpdateProduit', 'DeleteProduit', 'GetProduitById', 'GetAllProduit',
            'InsertCommande', 'UpdateCommande', 'DeleteCommande', 'GetCommandeById', 'GetAllCommande',
            'InsertCommandeProduit', 'UpdateCommandeProduit', 'DeleteCommandeProduit', 'GetCommandeProduits',
            'InsertPanierProduit', 'UpdatePanierProduit', 'DeletePanierProduit', 'GetPanierProduits',
            'InsertPanier', 'UpdatePanier', 'DeletePanier', 'GetPanierById', 'GetAllPanier'
        ];
 // Table Utilisateur
 $this->forge->addField([
    'id_utilisateur' => [
        'type'           => 'INT',
        'constraint'     => 11,
        'unsigned'       => true,
        'auto_increment' => true,
    ],
    'nom' => [
        'type'       => 'VARCHAR',
        'constraint' => 100,
    ],
    'email' => [
        'type'       => 'VARCHAR',
        'constraint' => 100,
        'unique'     => true,
    ],
    'mdp' => [
        'type'       => 'VARCHAR',
        'constraint' => 255,
    ],
    'telephone' => [
        'type'       => 'VARCHAR',
        'constraint' => 15,
    ],
    'adresse' => [
        'type'       => 'VARCHAR',
        'constraint' => 255,
    ],
    'type_utilisateur' => [
        'type'       => 'VARCHAR',
        'constraint' => 50,
        'null'       => true,
    ],
]);
$this->forge->addKey('id_utilisateur', true);
$this->forge->createTable('Utilisateur');

        foreach($procedures as $procedure) {
            $this->db->query("DROP PROCEDURE IF EXISTS {$procedure}");
        }
    }
}
