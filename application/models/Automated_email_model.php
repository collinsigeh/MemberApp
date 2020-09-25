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
            * - membershp_type
            * - user_status
            */
            $query = $this->db->get_where('users', array('id' => $user_id));
            $row = $query->row();

            // replacing values
            $message = str_replace('[title]', $row->title, $message);
            $message = str_replace('[firstname]', $row->firstname, $message);
            $message = str_replace('[lastname]', $row->lastname, $message);
            $message = str_replace('[fullname]', $row->firstname.' '.$row->lastname, $message);
            $message = str_replace('[email]', $row->email, $message);
            $message = str_replace('[membership_type]', $row->membership, $message);
            $message = str_replace('[member_status]', $row->use_status, $message);
            
            return $message;
        }

    }
?>