<?php
    class Member_resource_model extends CI_Model{
        
        public function get()
        {
            $query = $this->db->get('member_resources');
            return $query->result();
        }

        public function get_where($db_check)
        {
            $this->db->order_by('description ASC');
            $query = $this->db->get_where('member_resources', $db_check);
            return $query->result();
        }
        
        public function paginate($limit, $offset=0)
        {
            $this->db->order_by('description ASC');
            $this->db->limit($limit, $offset);
            $query = $this->db->get('member_resources');
            return $query->result();
        }
        
        public function paginate_where($db_check, $limit, $offset=0)
        {
            $this->db->order_by('description ASC');
            $this->db->limit($limit, $offset);
            $query = $this->db->get_where('member_resources', $db_check);
            return $query->result();
        }

        public function save($db_data)
        {
            return $this->db->insert('member_resources', $db_data);
        }

        public function find($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('member_resources');
            return $query->row();
        }
    }
?>