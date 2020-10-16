<?php
    class Payment_processor_model extends CI_Model{

        public function get()
        {
            $query = $this->db->get('payment_processors');
            return $query->result();
        }

        public function find($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('payment_processors');
            return $query->row();
        }

        public function get_where($db_check)
        {
            $query = $this->db->get_where('payment_processors', $db_check);
            return $query->row();
        }
    }
?>