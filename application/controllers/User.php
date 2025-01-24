<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model', 'user');
    $this->load->model('Course_model', 'course');
  }

  public function index()
  {
    if (!$this->session->userdata('logged_in')) {
      redirect('auth');
    }

    $data['title'] = 'Dashboard';
    $data['user_id'] = $this->session->userdata('user_id');
    $data['identity'] = $this->session->userdata('identity');
    $data['role'] = $this->session->userdata('role');
    $data['name'] = $this->session->userdata('name');

    if ($data['role'] == 'admin') {
      $data['users'] = $this->user->get_all();
    } elseif ($data['role'] == 'dosen') {
      $data['users'] = $this->user->get_all_by_lecturer($data['user_id']);
    } elseif ($data['role'] == 'mahasiswa') {
      $data['users'] = $this->course->get_enrolled($data['user_id']);
    } else {
      redirect('auth');
    }

    $this->load->view('templates/header', $data);
    if ($data['role'] == 'admin') {
      $this->load->view('dashboard/index', $data);
    } elseif ($data['role'] == 'dosen') {
      $this->load->view('dashboard/dosen', $data);
    } elseif ($data['role'] == 'mahasiswa') {
      $this->load->view('dashboard/mahasiswa', $data);
    }
    $this->load->view('templates/footer');
  }

  public function insert()
  {
    $data = [
      'role_identity' => htmlspecialchars($this->input->post('identity', true)),
      'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
      'role' => $this->input->post('role'),
      'name' => htmlspecialchars($this->input->post('name', true))
    ];

    $this->user->insert($data);
    redirect('dashboard');
  }

  public function change_status($id)
  {
    $user = $this->user->get_one($id);
    $data = ['status' => $user['status'] == 'active' ? 'inactive' : 'active'];

    $this->user->update($id, $data);
    redirect('dashboard');
  }

  public function delete($id)
  {
    $this->user->delete($id);
    redirect('dashboard');
  }
}
