<?php
    class User_model extends CI_Model{
        
        public function paginate($limit, $offset=0)
        {
            $this->db->order_by('firstname ASC, lastname ASC');
            $this->db->limit($limit, $offset);
            $query = $this->db->get('users');
            return $query->result();
        }
        
        public function get()
        {
            $this->db->order_by('firstname ASC, lastname ASC');
            $query = $this->db->get('users');
            return $query->result();
        }

        public function get_where($db_check)
        {
            $query = $this->db->get_where('users', $db_check);
            return $query->result_array();
        }

        public function find($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('users');
            return $query->row();
        }

        public function save($db_data)
        {
            return $this->db->insert('users', $db_data);
        }

        public function update($db_data, $id)
        {
            $this->db->where('id', $id);
            return $this->db->update('users', $db_data);
        }

        public function generate_new_password()
        {
            $password = '';
            while(strlen($password) < 9)
            {
                $random_number = rand(1,9);

                if($random_number == 1)
                {
                    $newchar = '#1u8';
                }
                if($random_number == 2)
                {
                    $newchar = '!C2';
                }
                if($random_number == 3)
                {
                    $newchar = '@3h7';
                }
                if($random_number == 4)
                {
                    $newchar = ')E34';
                }
                if($random_number == 5)
                {
                    $newchar = '$5k9';
                }
                if($random_number == 6)
                {
                    $newchar = '%W16';
                }
                if($random_number == 7)
                {
                    $newchar = '&a67';
                }
                if($random_number == 8)
                {
                    $newchar = 'jY48';
                }
                if($random_number == 9)
                {
                    $newchar = 'Ut59';
                }

                $password = $password.$newchar;
            }

            return $password;
        }
    }
?>