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
    }
?>