<?php
class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function validate_user($email, $password) {
        // Encriptar contraseña antes de buscarla en la base de datos
        $this->db->where('email', $email);
        $this->db->where('contrasenia', $password); // Asegúrate de usar el mismo método de encriptación que al guardar la contraseña
        $query = $this->db->get('usuarios');

        if ($query->num_rows() == 1) {
            return $query->row(); // Retorna el usuario
        } else {
            return false; // Usuario no encontrado
        }
    }
}
