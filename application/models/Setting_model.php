<?php
    class Setting_model extends CI_Model{

        public function get_timezone()
        {
            $this->db->select('timezone');
            $query = $this->db->get('settings');
            return $query->row()->timezone;
        }
    }
?>