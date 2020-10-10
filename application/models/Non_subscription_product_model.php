<?php
    class Non_subscription_product_model extends CI_Model{

        public function save($db_data)
        {
            return $this->db->insert('non_subscription_products', $db_data);
        }

        public function find($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('non_subscription_products');
            return $query->row();
        }

        public function get_where($db_check)
        {
            $query = $this->db->get_where('non_subscription_products', $db_check);
            return $query->result();
        }

        public function update_where($db_data, $db_check)
        {
            return $this->db->update('non_subscription_products', $db_data, $db_check);
        }
    }
?>