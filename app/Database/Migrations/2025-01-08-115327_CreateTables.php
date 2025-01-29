<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTables extends Migration
{
    public function up()
    {
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

        // Table Produit
        $this->forge->addField([
            'id_produit' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'categorie' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'prix' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'stock' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'img_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);
        $this->forge->addKey('id_produit', true);
        $this->forge->createTable('Produit');

        // Table Commande
        $this->forge->addField([
            'id_commande' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_utilisateur' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'date' => [
                'type' => 'DATE',
            ],
            'statut' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'prixtotal' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);
        $this->forge->addKey('id_commande', true);
        $this->forge->addForeignKey('id_utilisateur', 'Utilisateur', 'id_utilisateur', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Commande');

        // Table CommandeProduit
        $this->forge->addField([
            'id_details' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_commande' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'id_produit' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'quantite' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'prix' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);
        $this->forge->addKey('id_details', true);
        $this->forge->addForeignKey('id_commande', 'Commande', 'id_commande', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_produit', 'Produit', 'id_produit', 'CASCADE', 'CASCADE');
        $this->forge->createTable('CommandeProduit');

        // Table Panier
        $this->forge->addField([
            'id_panier' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_utilisateur' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'date' => [
                'type' => 'DATE',
            ],
            'prixtotal' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);
        $this->forge->addKey('id_panier', true);
        $this->forge->addForeignKey('id_utilisateur', 'Utilisateur', 'id_utilisateur', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Panier');

        // Table PanierProduit
        $this->forge->addField([
            'id_pan_prod' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_panier' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'id_produit' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'quantite' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'prix' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);
        $this->forge->addKey('id_pan_prod', true);
        $this->forge->addForeignKey('id_panier', 'Panier', 'id_panier', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_produit', 'Produit', 'id_produit', 'CASCADE', 'CASCADE');
        $this->forge->createTable('PanierProduit');

        // Table Paiement
        $this->forge->addField([
            'id_paiement' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_commande' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'methodepaiement' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'statut' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'date' => [
                'type' => 'DATE',
            ],
        ]);
        $this->forge->addKey('id_paiement', true);
        $this->forge->addForeignKey('id_commande', 'Commande', 'id_commande', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Paiement');
    }

    public function down()
    {
        // Supprimer les tables dans l'ordre inverse des dépendances
        $this->forge->dropTable('Paiement', true);
        $this->forge->dropTable('PanierProduit', true);
        $this->forge->dropTable('Panier', true);
        $this->forge->dropTable('CommandeProduit', true);
        $this->forge->dropTable('Commande', true);
        $this->forge->dropTable('Produit', true);
        $this->forge->dropTable('Utilisateur', true);
    }
}
