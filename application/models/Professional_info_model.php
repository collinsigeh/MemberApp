<?php
    class Professional_info_model extends CI_Model{

        public function save($db_data)
        {
            return $this->db->insert('professional_info', $db_data);
        }

        public function find($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('professional_info');
            return $query->row();
        }
    }
?>