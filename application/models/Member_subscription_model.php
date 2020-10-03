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
    }
?>