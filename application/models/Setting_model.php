<?php
    class Setting_model extends CI_Model{

        public function require_approval()
        {
            $this->db->select('require_manual_approval_on_new_reg');
            $query = $this->db->get('settings');
            return $query->row()->require_manual_approval_on_new_reg;
        }
    }
?>