<?php 

class projects_model extends CI_Model{

    public function get_projects(){
        $query = $this->db->get('projects');
        return $query->result();
}

 public function add_project($name, $description) {
        $data = [
            'name' => $name,
            'description' => $description
        ];

        return $this->db->insert('projects', $data);
    }
}

