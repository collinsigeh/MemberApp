<?php
    class Professional_info_model extends CI_Model{

        public function save($db_data)
        {
            return $this->db->insert('professional_info', $db_data);
        }
    }