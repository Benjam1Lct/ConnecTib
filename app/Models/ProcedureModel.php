<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcedureModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    /**
     * Appelle une procédure d'insertion pour une table donnée.
     * 
     * @param string $table Nom de la table cible.
     * @param array $params Paramètres de la procédure.
     * @return bool Succès ou échec.
     */
    public function insertModel(string $table, array $params)
    {
        $procedureName = "Insert" . ucfirst($table);
        $query = $this->buildQuery($procedureName, $params);

        return $this->db->query($query, $params);
    }

    /**
     * Appelle une procédure de mise à jour pour une table donnée.
     * 
     * @param string $table Nom de la table cible.
     * @param array $params Paramètres de la procédure.
     * @return bool Succès ou échec.
     */
    public function updateModel(string $table, array $params)
    {
        $procedureName = "Update" . ucfirst($table);
        $query = $this->buildQuery($procedureName, $params);

        return $this->db->query($query, $params);
    }

    /**
     * Appelle une procédure de suppression pour une table donnée.
     * 
     * @param string $table Nom de la table cible.
     * @param array $params Paramètres de la procédure.
     * @return bool Succès ou échec.
     */
    public function deleteModel(string $table, array $params)
    {
        $procedureName = "Delete" . ucfirst($table);
        $query = $this->buildQuery($procedureName, $params);

        return $this->db->query($query, $params);
    }

    /**
     * Appelle une procédure pour récupérer des données d'une table donnée et les transforme en entités.
     * 
     * @param string $table Nom de la table cible.
     * @param array $params Paramètres de la procédure.
     * @param string|null $entityClass Classe de l'entité associée.
     * @return array Liste des entités ou résultats bruts.
     */
    public function getModel(string $table, array $params, string $entityClass = null)
{
    $procedureName = "Get" . ucfirst($table);
    $query = $this->buildQuery($procedureName, $params);

    $result = $this->db->query($query, $params)->getRowArray();

    // Si une entité est spécifiée, transformez le résultat en objet entité
    if ($entityClass && $result) {
        return new $entityClass($result);
    }

    return $result; // Retourne un tableau brut si aucune entité n'est spécifiée
}


    public function getAllModel(string $table, string $entityClass = null)
{
    $procedureName = "GetAll" . ucfirst($table);
    $query = "CALL {$procedureName}()";

    $result = $this->db->query($query)->getResultArray();

    // Si une entité est spécifiée, transformez les résultats en objets entités
    if ($entityClass) {
        return array_map(function ($data) use ($entityClass) {
            return new $entityClass($data);
        }, $result);
    }

    return $result; // Retourne un tableau brut si aucune entité n'est spécifiée
}

    /**
     * Construit une requête CALL dynamique.
     * 
     * @param string $procedureName Nom de la procédure stockée.
     * @param array $params Paramètres à passer.
     * @return string Requête CALL.
     */
    private function buildQuery(string $procedureName, array $params): string
    {
        $placeholders = implode(',', array_fill(0, count($params), '?'));
        return "CALL {$procedureName}({$placeholders})";
    }


    public function getModelByEmail(string $email)
    {
        // Requête SQL directe pour récupérer l'utilisateur par son email
        $query = "SELECT * FROM Utilisateur WHERE email = ? ";
    
        // Exécute la requête avec le paramètre de l'email
        $result = $this->db->query($query, [$email])->getFirstRow();
    
        return $result; // Retourne l'utilisateur sous forme d'objet
    }

        public function insertQuery(string $table, array $data)
    {
        $columns = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?'));

        $query = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        return $this->db->query($query, array_values($data));
    }

    public function deleteQuery(string $table, array $conditions)
    {
        $where = [];
        foreach ($conditions as $key => $value) {
            $where[] = "{$key} = ?";
        }
        $whereClause = implode(' AND ', $where);

        $query = "DELETE FROM {$table} WHERE {$whereClause}";
        return $this->db->query($query, array_values($conditions));
    }

    public function getLastInsertId()
    {
        return $this->db->insertID(); // CodeIgniter retourne l'ID de la dernière insertion
    }

    public function updateQuery(string $table, array $data, array $conditions)
    {
        $builder = $this->db->table($table);
        $builder->where($conditions);
        return $builder->update($data);
    }

    public function updateUserDetails(string $table, array $conditions, array $data)
    {
        try {
            // Utilisation du Query Builder pour effectuer la mise à jour
            $this->db->table($table)
                     ->where($conditions)
                     ->update($data);
            
            // Vérification des lignes affectées
            if ($this->db->affectedRows() === 0) {
                throw new \Exception("Aucune ligne mise à jour.");
            }
        } catch (\Exception $e) {
            log_message('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
            throw $e; // Rejeter l'exception pour qu'elle soit capturée dans la méthode appelante
        }

    }

    public function updateUserRole(string $table, int $userId, string $newRole)
    {
        try {
            // Utilisation du Query Builder pour mettre à jour le rôle de l'utilisateur
            $this->db->table($table)
                    ->where('id_utilisateur', $userId) // Condition pour l'utilisateur spécifique
                    ->update(['type_utilisateur' => $newRole]); // Mise à jour du rôle
            
            // Vérification des lignes affectées
            if ($this->db->affectedRows() === 0) {
                throw new \Exception("Aucun changement effectué. L'utilisateur n'a pas été trouvé ou le rôle est déjà celui spécifié.");
            }
        } catch (\Exception $e) {
            log_message('error', 'Erreur lors de la mise à jour du rôle de l\'utilisateur : ' . $e->getMessage());
            throw $e; // Rejeter l'exception pour qu'elle soit capturée dans la méthode appelante
        }
    }

    public function getAllCommandProduit()
    {
        // Utilisation du Query Builder pour mettre à jour le rôle de l'utilisateur
        $result = $this->db->table('CommandeProduit')
        ->get(); // Exécution de la requête SELECT

        $data = $result->getResult();

        return $data; // Retourner les résultats pour un traitement ultérieur
    }


}
