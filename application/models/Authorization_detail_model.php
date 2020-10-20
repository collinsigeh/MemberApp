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

        public function get_where($db_check)
        {
            $query = $this->db->get_where('authorization_detail', $db_check);
            return $query->result();
        }

        public function update($db_data, $id)
        {
            $this->db->where('id', $id);
            return $this->db->update('authorization_detail', $db_data);
        }

        public function update_where($db_data, $db_check)
        {
            return $this->db->update('authorization_detail', $db_data, $db_check);
        }
    }
?>