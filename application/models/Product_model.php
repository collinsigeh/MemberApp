<?php
    class Product_model extends CI_Model{
        
        public function paginate($limit, $offset=0)
        {
            $this->db->order_by('name ASC');
            $this->db->limit($limit, $offset);
            $query = $this->db->get('products');
            return $query->result();
        }
        
        public function get()
        {
            $query = $this->db->get('products');
            return $query->result();
        }

        public function get_where($db_check)
        {
            $query = $this->db->get_where('products', $db_check);
            return $query->result();
        }
    }
?>