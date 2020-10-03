<?php
    class Authorization_detail_model extends CI_Model{

        public function save($db_data)
        {
            return $this->db->insert('authorization_detail', $db_data);
        }

        public function find($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('authorization_detail');
            return $query->row();
        }
    }
?>