<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('Auth_model', 'auth');
  }

  public function index()
  {
    if ($this->session->userdata('logged_in')) {
      redirect('dashboard');
    }

    $this->form_validation->set_rules('identity', 'Identity', 'required|trim');
    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Login';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/login');
      $this->load->view('templates/auth_footer');
    } else {
      $identity = $this->input->post('identity');
      $password = $this->input->post('password');

      $user = $this->auth->login($identity, $password);

      if ($user) {
        $this->session->set_userdata('user_id', $user['user_id']);
        $this->session->set_userdata('identity', $user['role_identity']);
        $this->session->set_userdata('role', $user['role']);
        $this->session->set_userdata('name', $user['name']);
        $this->session->set_userdata('logged_in', true);

        redirect('dashboard');
      } else {
        $this->session->set_flashdata('error', 'Invalid username or password');
        redirect('auth');
      }
    }
  }

  public function register()
  {
    if ($this->session->userdata('logged_in')) {
      redirect('dashboard');
    }

    $this->form_validation->set_rules('identity', 'Identity', 'required|trim');
    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('role', 'Role', 'required|trim');
    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Register';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/register');
      $this->load->view('templates/auth_footer');
    } else {
      $data = [
        'role_identity' => htmlspecialchars($this->input->post('identity', true)),
        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        'role' => $this->input->post('role'),
        'name' => htmlspecialchars($this->input->post('name', true))
      ];

      $this->auth->register($data);
      $this->session->set_flashdata('msg', 'Account has been created!');
      redirect('auth');
    }
  }

  public function logout()
  {
    $this->session->unset_userdata('logged_in');
    $this->session->sess_destroy();

    redirect('auth');
  }
}
