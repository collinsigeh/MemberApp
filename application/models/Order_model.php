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
        
        public function paginate($limit, $offset=0)
        {
            $this->db->order_by('crated_at DESC');
            $this->db->limit($limit, $offset);
            $query = $this->db->get('orders');
            return $query->result();
        }
        
        public function paginate_where($db_check, $limit, $offset=0)
        {
            $this->db->order_by('created_at DESC');
            $this->db->limit($limit, $offset);
            $query = $this->db->get_where('orders', $db_check);
            return $query->result();
        }
    }
?>