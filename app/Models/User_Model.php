<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    /**
     * 1) Vérifie si un email existe déjà
     */
    public function email_exists(string $email): bool {
        $query = $this->db->select('id_utilisateur')
            ->from('utilisateurs')
            ->where('email', $email)
            ->limit(1)
            ->get();

        return $query->num_rows() > 0;
    }

    /**
     * 2) Reçoit les données du formulaire et insère l'utilisateur
     * Reçoit : nom, email, genre, mot_de_passe
     *
     * @return int|false ID inséré (id_utilisateur) sinon false
     */
    public function create_user(array $data) {
        // On s'assure des champs attendus (et on ignore le reste)
        $payload = [
            'nom' => $data['nom'] ?? null,
            'email' => $data['email'] ?? null,
            'genre' => $data['genre'] ?? null,
            'mot_de_passe' => $data['mot_de_passe'] ?? null,
        ];

        // Optionnel: valider rapidement les champs requis
        if (empty($payload['nom']) || empty($payload['email']) || empty($payload['mot_de_passe']) || empty($payload['genre'])) {
            return false;
        }

        if ($this->db->insert('utilisateurs', $payload)) {
            // 3) Récupération de l'ID généré
            return (int) $this->db->insert_id();
        }

        return false;
    }

    // Alias rétro-compat (si d'autres parties utilisent insert_user)
    public function insert_user($data) {
        return $this->create_user($data);
    }

    // Utile pour la connexion plus tard
    public function check_login($email, $password) {
        $query = $this->db->get_where('utilisateurs', array('email' => $email, 'mot_de_passe' => $password));
        return $query->row_array();
    }
}

