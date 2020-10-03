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

        public function get_where($db_check)
        {
            $query = $this->db->get_where('professional_info', $db_check);
            return $query->result();
        }
    }
?>