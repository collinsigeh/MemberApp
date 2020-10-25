<?php
    class Member_subscription_model extends CI_Model{
        
        public function get()
        {
            $query = $this->db->get('member_subscription');
            return $query->result();
        }

        public function get_where($db_check)
        {
            $this->db->order_by('subscription_start DESC');
            $query = $this->db->get_where('member_subscription', $db_check);
            return $query->result();
        }
        
        public function paginate($db_check, $limit, $offset=0)
        {
            $this->db->order_by('subscription_start ASC');
            $this->db->limit($limit, $offset);
            $query = $this->db->get_where('member_subscription');
            return $query->result();
        }
        
        public function paginate_where($db_check, $limit, $offset=0)
        {
            $this->db->order_by('subscription_start ASC');
            $this->db->limit($limit, $offset);
            $query = $this->db->get_where('member_subscription', $db_check);
            return $query->result();
        }

        public function update($db_data, $id)
        {
            $this->db->where('id', $id);
            return $this->db->update('member_subscription', $db_data);
        }

        public function update_where($db_data, $db_check)
        {
            return $this->db->update('member_subscription', $db_data, $db_check);
        }

        public function save($db_data)
        {
            return $this->db->insert('member_subscription', $db_data);
        }

        public function find($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('member_subscription');
            return $query->row();
        }

        public function delete_where($db_check)
        {
            return $this->db->delete('member_subscription', $db_check);
        }
    }
?>