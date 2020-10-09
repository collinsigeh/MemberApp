<?php
    class Subscription_product_model extends CI_Model{

        public function save($db_data)
        {
            return $this->db->insert('subscription_products', $db_data);
        }

        public function find($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('subscription_products');
            return $query->row();
        }

        public function get_where($db_check)
        {
            $query = $this->db->get_where('subscription_products', $db_check);
            return $query->result();
        }

        public function update_where($db_data, $db_check)
        {
            return $this->db->update('subscription_products', $db_data, $db_check);
        }
    }
?>