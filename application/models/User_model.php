<?php
    class User_model extends CI_Model{

        public function get($db_check)
        {
            $query = $this->db->get_where('users', $db_check);
            return $query->result_array();
        }
    }
?>