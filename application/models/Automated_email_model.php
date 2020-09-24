<?php
    class Automated_email_model extends CI_Model{

        public function get_where($db_check)
        {
            $query = $this->db->get_where('automated_emails', $db_check);
            return $query->result_array();
        }

        public function message_cleanup($message, $user_id)
        {
            /*
            * cleans out the following:
            * - title
            * - firstname
            * - lastname
            * - fullname
            * - email
            * - password
            */
            return $message;
        }

    }
?>