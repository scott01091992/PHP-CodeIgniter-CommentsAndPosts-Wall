<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wall extends CI_Controller {

	public function user_wall($id){
		$this->load->model('Wall_model');
		$user = $this->Wall_model->get_user($id);
		$messages = $this->Wall_model->get_messages($id);
		$this->load->view('user_wall', array('user' => $user, 'messages' => $messages));
	}

	public function admin_edit($id){
		$this->load->library(array('form_validation', 'session'));
		$this->load->model("Wall_model");
		$user = $this->Wall_model->get_user($id);
		$this->load->view('admin_profile_edit', array('user' => $user));
	}

	public function admin_remove($id){
		$this->load->model('Wall_model');
		$this->Wall_model->delete_user($id);
		redirect("admin_dashboard");
	}

	public function profile(){
		$this->load->library(array('form_validation', 'session'));
		$this->load->model("Wall_model");
		$user = $this->Wall_model->get_user($this->session->userdata('current_user'));
		$this->load->view('profile', array('user' => $user));
	}

	public function admin_profile(){
		$this->load->library(array('form_validation', 'session'));
		$this->load->model("Wall_model");
		$user = $this->Wall_model->get_user($this->session->userdata('current_user'));
		$this->load->view('admin_profile', array('user' => $user));
	}

	public function admin_update_password($id){
		$this->load->library(array('form_validation', 'session'));
		$this->form_validation->set_rules('password', 'password', 'required|min_length[8]|max_length[255]');
		$this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[password]');
		if($this->form_validation->run() == false){
			$this->load->model("Wall_model");
			$user = $this->Wall_model->get_user($id);
			$this->load->view('admin_profile_edit', array('user' => $user));
		}else{
			$this->load->model('Wall_model');
			$this->Wall_model->admin_update_password($id);
			redirect('/admin_dashboard');
		}
	}

	public function update_password(){
		$this->load->library(array('form_validation', 'session'));
		$this->form_validation->set_rules('password', 'password', 'required|min_length[8]|max_length[255]');
		$this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[password]');
		if($this->form_validation->run() == false){
			$this->load->view('profile');
		}else{
			$this->load->model('Wall_model');
			$this->Wall_model->update_password();
			redirect('profile');
		}
	}

	public function admin_update_description($id){
		$this->load->library(array('form_validation', 'session'));
		$this->form_validation->set_rules('description', 'description', 'required');
		if($this->form_validation->run() == false){
			$this->load->model("Wall_model");
			$user = $this->Wall_model->get_user($id);
			$this->load->view('admin_profile_edit', array('user' => $user));
		}else{
			$this->load->model('Wall_model');
			$this->Wall_model->admin_update_description($id);
			redirect('/admin_dashboard');
		}
	}

	public function update_description(){
		$this->load->library(array('form_validation', 'session'));
		$this->form_validation->set_rules('description', 'description', 'required');
		if($this->form_validation->run() == false){
			$this->load->view('profile');
		}else{
			$this->load->model('Wall_model');
			$this->Wall_model->update_description();
			redirect('profile');
		}
	}

	public function update_info(){
		$this->load->library(array('form_validation', 'session'));
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|max_length[255]');
		$this->form_validation->set_rules('first_name', 'first_name', 'required|max_length[45]|min_length[2]');
		$this->form_validation->set_rules('last_name', 'last_name', 'required|max_length[45]|min_length[2]');
		if($this->form_validation->run() == false){
			$this->load->model("Wall_model");
			$user = $this->Wall_model->get_user($id);
			$this->load->view('admin_profile_edit', array('user' => $user));
		}else{
			$this->load->model('Wall_model');
			$this->Wall_model->update_info();
			redirect('profile');			
		}

	}

	public function admin_update_info($id){
		$this->load->library(array('form_validation', 'session'));
		$this->form_validation->set_rules('first_name', 'first_name', 'required|max_length[45]|min_length[2]');
		$this->form_validation->set_rules('last_name', 'last_name', 'required|max_length[45]|min_length[2]');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|max_length[255]');
		if($this->form_validation->run() == false){
			$this->load->model("Wall_model");
			$user = $this->Wall_model->get_user($id);
			$this->load->view('admin_profile_edit', array('user' => $user));
		}
		else{
			$this->load->model("Wall_model");
			$this->Wall_model->admin_update_info($id);
			redirect("/admin_dashboard");
		}
	}

	public function add_comment($message_id){
		$this->load->library(array('form_validation', 'session'));
		$this->load->model('Wall_model');
		$this->Wall_model->insert_comment($message_id);
		redirect('show/'.$this->input->post('page'));
	}

	public function add_message($page){
		$this->load->library(array('form_validation', 'session'));
		$this->load->model('Wall_model');
		$this->Wall_model->insert_message($page);
		redirect('show/'.$page);
	}

	public function signout(){
		$this->load->library(array('session'));
		$this->session->sess_destroy();
		redirect('/');
	}

	public function signin(){
		$this->load->library(array('form_validation', 'session'));
		$this->load->view('signin');
	}

	public function register(){
		$this->load->library(array('form_validation', 'session'));
		$this->load->view('register');
	}

	public function dashboard(){
		if($this->session->userdata('current_user')){
			$this->load->model('Wall_model');
			$users = $this->Wall_model->get_all_users();
			$this->load->view('dashboard', array('users' => $users));
		}else{
			redirect('/');
		}
	}

	public function admin_dashboard(){
		if($this->session->userdata('current_user') && $this->session->userdata('admin')){
			$this->load->model('Wall_model');
			$users = $this->Wall_model->get_all_users();
			$this->load->view('admin_dashboard', array('users' => $users));
		}else{
			redirect('/');
		}
	}

	public function login(){
		$this->load->library(array('form_validation', 'session'));
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|max_length[255]');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[8]|max_length[255]');
		if($this->form_validation->run() == false){
			$this->load->view('signin');
		}else{
			$this->load->model('Wall_model');
			$result = $this->Wall_model->signin_user();
			if($result != false){
				$this->session->set_userdata('current_user', $result);
				if($this->session->userdata('admin')){
					redirect('admin_dashboard');
				}
				else{
					redirect("dashboard");
				}
			}else{
				$this->session->set_flashdata('result', 'Email or password does not exist');
				$this->load->view('signin');
			}
		}
	}

	public function register_user(){
		$this->load->library(array('form_validation', 'session'));
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|max_length[255]');
		$this->form_validation->set_rules('first_name', 'first_name', 'required|max_length[45]|min_length[2]');
		$this->form_validation->set_rules('last_name', 'last_name', 'required|max_length[45]|min_length[2]');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[8]|max_length[255]');
		$this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[password]');
		if($this->form_validation->run() == false){
			$this->load->view('register');
		}
		else{
			$this->load->model('Wall_model');
			$result = $this->Wall_model->add_user();
			$this->session->set_flashdata('result', $result);
			if($result == "Successfully registered"){
				$this->load->view('signin');
			}
			else{
				$this->load->view('register');
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */