<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wall_model extends CI_Model {

	public function get_all_users(){
		return $this->db->query("SELECT first_name, last_name, email, id, created_at, security_level FROM users")->result_array();
	}

	public function get_messages($id){
		$messages = $this->db->query("SELECT message, messages.id, messages.users_id, first_name, last_name, messages.created_at FROM messages LEFT JOIN users ON messages.users_id = users.id WHERE wall_id = {$id}")->result_array();
		$data = array('messages' => array());
		foreach($messages as $message){
			$data['messages'][] = array('message' => $message, 'comments' => $this->db->query('SELECT first_name, last_name, comments.created_at, comment FROM comments LEFT JOIN users ON comments.users_id = users.id WHERE '.$message['id']."= comments.messages_id")->result_array());
		}
		return $data;
	}

	public function admin_update_description($id){
		$this->db->update('users', array('description' => $this->input->post('description')), array('id' => $id));
	}

	public function admin_update_info($id){
		$this->db->update('users', array('first_name' => $this->input->post('first_name'), 'last_name' => $this->input->post('last_name'), 'email' => $this->input->post('email')), array('id' => $id));
	}

	public function admin_update_password($id){
		$salt = bin2hex(openssl_random_pseudo_bytes(22));
		$encrypted_password=md5($this->input->post('password')."".$salt);
		$this->db->update('users', array('password' => $encrypted_password), array('id' => $id));
	}

	public function update_description(){
		$this->db->update('users', array('description' => $this->input->post('description')) , array('id' => $this->session->userdata('current_user')));
	}

	public function delete_user($id){
		$this->db->delete('users', array('id' => $id)); 
	}

	public function update_info(){
		$this->db->update('users', array('first_name' => $this->input->post('first_name'), 'last_name' => $this->input->post('last_name'), 'email' => $this->input->post('email')), array('id' => $this->session->userdata('current_user')));
	}

	public function update_password(){
		$salt = bin2hex(openssl_random_pseudo_bytes(22));
		$encrypted_password=md5($this->input->post('password')."".$salt);
		$safe_data = array('password' => $encrypted_password);
		$this->db->update('users', $safe_data, array('id' => $this->session->userdata('current_user')));
	}

	public function insert_comment($message_id){
		$this->db->insert('comments', array('comment'=> $this->db->escape($this->input->post('comment_text')), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'users_id' => $this->session->userdata('current_user'), 'messages_id' => $message_id));
	}

	public function insert_message($wall_id){
		$this->db->insert('messages', array('message'=> $this->db->escape($this->input->post('message_text')), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'users_id' => $this->session->userdata('current_user'), 'wall_id' => $wall_id));
	}

	public function get_user($id){
		return $this->db->get_where('users', array('id' => $id))->row_array();
	}

	public function signin_user(){
 		$user_query = $this->db->get_where('users', array('email' => $this->input->post('email')))->row_array();
 		if($user_query != null){
 			$encrypted_password = md5($safe_password.''.$user_query['salt']);
 			if($user_query['password'] == $encrypted_password){
 				if($user_query['security_level'] == '9'){
 					$this->session->set_userdata('admin', true);
 				}
 				return $user_query['id'];
 			}else{
 				return false;
 			}
 		}else{
 			return false;
 		}
	}

	public function add_user(){
		$salt = bin2hex(openssl_random_pseudo_bytes(22));
		$encrypted_password=md5($this->input->post('password')."".$salt);
		$query = $this->db->get_where("users", array('email' => $safe_email))->row_array();
		$admin_exists = $this->db->get_where("users", array('security_level' => 9))->row_array();

		if($admin_exists == null){//if admin has not been set this user is now admin
			$this->db->insert('users', array('first_name' => $this->input->post('first_name'), 'last_name' => $this->input->post('last_name'), 'email' => $this->input->post('email'), 'password' => $encrypted_password, 'salt' => $salt, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'security_level' => 9));
			return "Successfully registered";
		}
		else{
			if($query == null){
				$this->db->insert('users', array('first_name' => $this->input->post('first_name'), 'last_name' => $this->input->post('last_name'), 'email' => $this->input->post('email'), 'password' => $encrypted_password, 'salt' => $salt, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'security_level' => 0));
				return "Successfully registered";

			}
			else{
				return "This email is already registered";
			}
		}
	}
}
	

