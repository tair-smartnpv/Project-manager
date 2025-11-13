<?php 

class Tasks_model extends CI_Model{
    public function __construct()
        {
           $this->load->database('tasks');
        
        }

    public function get_tasks()   {
        $query = $this->db->get('tasks');
        return $query->result();

        }    


    public function add_task($title )
     {   $data= [
            'title' => $title
        ];

        return $this->db->insert('tasks',$data);
}

    public function delete_task($id){
        $this->db->delete('tasks' , array('id'=>$id));
    }


public function get_by_project($id ){
    $query = $this->db->where('project_id=',$id);

    return $query;
}

    }