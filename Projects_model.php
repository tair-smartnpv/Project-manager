<?php 

class projects_model extends CI_Model{
    public function __construct()
        {
            $this->load->database('ptojects');
        }

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

    public function delete_project($id) {
        $this->db->delete('projects',array('id'=>$id));

    }

}

