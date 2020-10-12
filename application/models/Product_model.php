<?php
    class Product_model extends CI_Model{
        
        public function paginate($limit, $offset=0)
        {
            $this->db->order_by('name ASC');
            $this->db->limit($limit, $offset);
            $query = $this->db->get('products');
            return $query->result();
        }
        
        public function paginate_where($db_check, $limit, $offset=0)
        {
            $this->db->order_by('name ASC');
            $this->db->limit($limit, $offset);
            $query = $this->db->get_where('products');
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

        public function find($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('products');
            return $query->row();
        }

        public function save($db_data)
        {
            return $this->db->insert('products', $db_data);
        }

        public function update($db_data, $id)
        {
            $this->db->where('id', $id);
            return $this->db->update('products', $db_data);
        }
    }
?>