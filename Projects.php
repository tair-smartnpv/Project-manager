<?php 
/**
 * @property projects_model $projects_model
 * @property input $input
 */
class projects extends CI_Controller{

public function __construct()
    {
        parent::__construct();
        $this->load->model('projects_model');
        $this->load->helper('url'); 

       
    }
    public function index(){
       
        $data['projects'] = $this->projects_model->get_projects();
        $this->load->view('projects_view', $data);

    }
    public function get_projects(){
       $projects = $this->projects_model->get_projects();

      if(!empty($projects)){  foreach ($projects as $p) {
        echo "<div class='project' id='project-{$p->id}'>
                <p><strong>{$p->name}</strong> - {$p->description}</p>
                <a href='" . site_url('Tasks/' . $p->id) . "' class='btn btn-primary'>tasks</a>

                <button class='delete-btn' data-id='{$p->id}'>delete</button>
              </div>";
    }}
    else{
        echo "not projects";
    }
    }
public function add(){
    // $this->load->helper('form');
    // $this->load->library('form_validation');
     $name = $this->input->post('name');
    $description = $this->input->post('description');
    $this->projects_model->add_project($name,$description);
    // $data['projects'] = $this->projects_model->get_projects();
    // $this->load->view('projects_view', $data);
   



}

    public function delete($id = null){
        // $name = $this->input->post('name');
        $this->projects_model->delete_project($id);
        // $data['projects'] = $this->projects_model->get_projects();
        // $this->load->view('projects_view', $data);

    }
    

}
