<?php
    class Student_info_model extends CI_Model{

        public function save($db_data)
        {
            return $this->db->insert('student_info', $db_data);
        }

        public function find($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('student_info');
            return $query->row();
        }
    }
?>