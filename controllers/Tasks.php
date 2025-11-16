<?php
/**
 * @property Tasks_model $Tasks_model
 * @property Projects_model $Projects_model
 *
 * @property input $input
 */

class Tasks extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tasks_model');
		$this->load->helper('url');
		$this->load->model('Projects_model');

	}


	public function index($project_id = null)
	{

		$data['project'] = $this->Projects_model->get_project($project_id);
		$data['project_id'] = $project_id;
		$this->load->view('Tasks_view', $data);
	}

	public function get_by_project($project_id)
	{
		$tasks = $this->Tasks_model->get_tasks_by_project($project_id);
		echo json_encode($tasks);

	}

	public function add()
	{

		$title = $this->input->post('title');
		$created_at =time();
		$status = 'pending';
		$project_id = $this->input->post('p_id');
		$id = $this->Tasks_model->add_task($title,$status,$project_id,$created_at);

		echo json_encode([
			'title' => $title,
			'created_at' => $created_at,
			'status' => $status,
			'project_id' => $project_id
		]);


	}

	public function delete()
	{
		$id = $this->input->post('id');
		$this->Tasks_model->delete_task($id);
		$data['tasks'] = $this->Tasks_model->get_tasks();
		$this->load->view('Tasks_view', $data);

	}
	public function update(){
		$status = $this->input->post('status');
		$id = $this->input->post('task_id');
		$this->Tasks_model->update_task($id,$status);
		echo json_encode(['success' => true]);

	}


}
