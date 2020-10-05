<?php
    class Order_model extends CI_Model{
        
        public function get()
        {
            $query = $this->db->get('orders');
            return $query->result();
        }

        public function get_where($db_check)
        {
            $this->db->order_by('created_at DESC');
            $query = $this->db->get_where('orders', $db_check);
            return $query->result();
        }
    }
?>