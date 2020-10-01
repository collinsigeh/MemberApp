<?php
    class Setting_model extends CI_Model{

        public function require_approval()
        {
            $this->db->select('require_manual_approval_on_new_reg');
            $query = $this->db->get('settings');
            return $query->row()->require_manual_approval_on_new_reg;
        }

        public function get()
        {
            //$this->db->select('main_admin_email', 'send_admin_email_on_new_reg');
            $query = $this->db->get('settings');
            return $query->row();
        }

        public function update($db_data)
        {
            //$this->db->where('id', $id);
            $this->db->update('settings', $db_data);
        }
    }
?>