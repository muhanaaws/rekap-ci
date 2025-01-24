<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assessment extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Assessment_model', 'assessment');
    $this->load->model('Course_model', 'course');
  }

  public function index()
  {
    if (!$this->session->userdata('logged_in')) {
      redirect('auth');
    }

    $data['title'] = 'Penilaian';
    $data['user_id'] = $this->session->userdata('user_id');
    $data['identity'] = $this->session->userdata('identity');
    $data['role'] = $this->session->userdata('role');
    $data['name'] = $this->session->userdata('name');

    if ($data['role'] == 'admin') {
      $data['assessments'] = $this->assessment->get_all();
      $data['courses'] = $this->course->get_all();
    } elseif ($data['role'] == 'dosen') {
      $data['assessments'] = $this->assessment->get_all();
      $data['courses'] = $this->course->find(['lecturer_id' => $data['user_id']]);
    }

    $this->load->view('templates/header', $data);
    if ($data['role'] == 'admin') {
      $this->load->view('assessment/index', $data);
    } elseif ($data['role'] == 'dosen') {
      $this->load->view('assessment/dosen', $data);
    }
    $this->load->view('templates/footer');
  }

  public function insert()
  {
    $data = [
      'course_id' => $this->input->post('course_id', true),
      'component_name' => $this->input->post('component_name', true),
      'component_weight' => $this->input->post('component_weight') / 100
    ];

    $this->assessment->insert($data);
    redirect('assessment');
  }

  public function update($id)
  {
    $data = [
      'course_id' => $this->input->post('course_id', true),
      'component_name' => $this->input->post('component_name', true),
      'component_weight' => $this->input->post('component_weight') / 100
    ];

    $this->assessment->update($id, $data);
    redirect('assessment');
  }

  public function delete($id)
  {
    $this->assessment->delete($id);
    redirect('assessment');
  }
}
