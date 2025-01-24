<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Enrollment extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Enrollment_model', 'enrollment');
    $this->load->model('Course_model', 'course');
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

    $data['courses'] = $this->course->get_all_by_student($data['user_id']);

    $this->load->view('templates/header', $data);
    if ($data['role'] == 'admin' || $data['role'] == 'dosen') {
      redirect('course');
    } elseif ($data['role'] == 'mahasiswa') {
      $this->load->view('course/mahasiswa', $data);
    }
    $this->load->view('templates/footer');
  }

  public function enroll($id)
  {
    $data = [
      'student_id' => $this->session->userdata('user_id'),
      'course_id' => $id
    ];

    $this->enrollment->insert($data);
    redirect('enrollment');
  }
}
