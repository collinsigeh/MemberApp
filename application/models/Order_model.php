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
            $this->db->order_by('created_at DESC');
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

        public function save($db_data)
        {
            return $this->db->insert('orders', $db_data);
        }

        public function find($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('orders');
            return $query->row();
        }

        public function update_where($db_data, $db_check)
        {
            return $this->db->update('orders', $db_data, $db_check);
        }

        public function delete_where($db_check)
        {
            return $this->db->delete('orders', $db_check);
        }
    }
?>