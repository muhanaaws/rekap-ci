<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Course_model', 'course');
    $this->load->model('User_model', 'user');
  }

  public function index()
  {
    if (!$this->session->userdata('logged_in')) {
      redirect('auth');
    }

    $data['title'] = 'Kelas';
    $data['user_id'] = $this->session->userdata('user_id');
    $data['identity'] = $this->session->userdata('identity');
    $data['role'] = $this->session->userdata('role');
    $data['name'] = $this->session->userdata('name');

    if ($data['role'] == 'admin') {
      $data['courses'] = $this->course->get_all();
      $data['lecturers'] = $this->user->find(['role' => 'dosen']);
    } elseif ($data['role'] == 'dosen') {
      $data['courses'] = $this->course->find(['lecturer_id' => $data['user_id']]);
    } else {
      redirect('auth');
    }

    $this->load->view('templates/header', $data);
    if ($data['role'] == 'admin') {
      $this->load->view('course/index', $data);
    } elseif ($data['role'] == 'dosen') {
      $this->load->view('course/dosen', $data);
    } elseif ($data['role'] == 'mahasiswa') {
      redirect('enrollment');
    }
    $this->load->view('templates/footer');
  }

  public function insert()
  {
    $data = [
      'course_code' => $this->input->post('course_code', true),
      'course_name' => $this->input->post('course_name', true),
      'credit' => $this->input->post('credit'),
      'lecturer_id' => $this->input->post('lecturer_id')
    ];

    $this->course->insert($data);
    redirect('kelas');
  }

  public function update($id)
  {
    $data = [
      'course_code' => $this->input->post('course_code', true),
      'course_name' => $this->input->post('course_name', true),
      'credit' => $this->input->post('credit'),
      'lecturer_id' => $this->input->post('lecturer_id')
    ];

    $this->course->update($id, $data);
    redirect('kelas');
  }

  public function delete($id)
  {
    $this->course->delete($id);
    redirect('kelas');
  }
}
