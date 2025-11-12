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
                $this->load->helper('url'); // ← שורה חשובה!

       
    }
    public function index(){
       
                $data['projects'] = $this->projects_model->get_projects();
$this->load->view('projects_view', $data);

    }
  public function add() {
        // בדיקה אם יש POST (אם המשתמש שלח את הטופס)
        if ($this->input->post()) {
            $name = $this->input->post('name');
            $description = $this->input->post('description');

            // שמירה למסד נתונים דרך המודל
            $this->projects_model->add_project($name, $description);

            // חזרה לדף הרשימה
            redirect('projects');
        } else {
            // אם עוד לא נשלח טופס — פשוט הצג את הדף
            $this->load->view('add_project');
        }
    }

}
