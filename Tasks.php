<?php 
/**
 * @property Tasks_model $Tasks_model
 * @property input $input
 */

class Tasks extends CI_Controller{
    public function __construct()
        {
            parent::__construct();
            $this->load->model('Tasks_model');
            $this->load->helper('url');
        }


        public function index($project_id =null){
            $data['tasks'] = $this->Tasks_model->get_by_project($project_id);
            $data['project_id'] = $project_id;
            $this->load->view('Tasks_view',$data);
        }
        public function get_tasks(){
            $tasks = $this->Tasks_model->get_tasks();
            foreach ($tasks as $task) {
                echo "<div class='task' id = 'task-{$task->id}'>
                            <p>{$task->title}</p>
                            <button class='delete-btn' data-id = '{$task->id}'>delete</button>
                    </div>";
                
            }
        }

        public function add(){
            $this->load->helper('form');
            $this->load->library('form_validation');
            $title = $this->input->post('title');
            $this->Tasks_model->add_task($title);
            $data['tasks'] = $this->Tasks_model->get_tasks();
            $this->load->view('Tasks_view',$data);
            
        }
    public function delete(){
        $id = $this->input->post('id');
        $this->Tasks_model->delete_task($id);
        $data['tasks'] = $this->Tasks_model->get_tasks();
        $this->load->view('Tasks_view', $data);

    }




}