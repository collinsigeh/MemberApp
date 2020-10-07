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

        public function get_where($db_check)
        {
            $query = $this->db->get_where('student_info', $db_check);
            return $query->result();
        }

        public function update_where($db_data, $db_check)
        {
            return $this->db->update('student_info', $db_data, $db_check);
        }
    }
?>