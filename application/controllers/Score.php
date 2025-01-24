<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Score extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Score_model', 'score');
    $this->load->model('User_model', 'user');
    $this->load->model('Course_model', 'course');
    $this->load->model('Enrollment_model', 'enrollment');
    $this->load->model('Assessment_model', 'assessment');
  }

  public function index()
  {
    if (!$this->session->userdata('logged_in')) {
      redirect('auth');
    }

    $data['title'] = 'Input nilai';
    $data['user_id'] = $this->session->userdata('user_id');
    $data['identity'] = $this->session->userdata('identity');
    $data['role'] = $this->session->userdata('role');
    $data['name'] = $this->session->userdata('name');

    if ($this->session->userdata('selected_student')) {
      $data['selected_student'] = $this->session->userdata('selected_student');
    } else {
      $data['selected_student'] = [];
    }

    if ($this->session->userdata('student_course')) {
      $data['student_course'] = $this->session->userdata('student_course');
    } else {
      $data['student_course'] = [];
    }

    if ($this->session->userdata('selected_enrollment')) {
      $data['selected_enrollment'] = $this->session->userdata('selected_enrollment');
    } else {
      $data['selected_enrollment'] = [];
    }

    if ($this->session->userdata('enrollment_component')) {
      $data['enrollment_component'] = $this->session->userdata('enrollment_component');
    } else {
      $data['enrollment_component'] = [];
    }

    $this->load->view('templates/header', $data);
    $this->load->view('score/index', $data);
    $this->load->view('templates/footer');
  }

  public function find_student()
  {
    $this->session->unset_userdata('selected_enrollment');
    $this->session->unset_userdata('enrollment_component');

    $role_identity = $this->input->post('role_identity');

    $selected_student = $this->user->find_student($role_identity);
    $student_course = $this->course->get_enrolled($selected_student['user_id']);

    $this->session->set_userdata('selected_student', $selected_student);
    $this->session->set_userdata('student_course', $student_course);

    redirect('input_nilai');
  }

  public function find_course_component()
  {
    $course_id = $this->input->post('course_id') ? $this->input->post('course_id') :  $this->session->userdata('selected_course');
    $selected_student = $this->session->userdata('selected_student');

    $selected_enrollment = $this->enrollment->find_selected($selected_student['user_id'], $course_id);
    $enrollment_component = $this->assessment->find_selected($selected_enrollment['enrollment_id'], $course_id);

    $this->session->set_userdata('selected_enrollment', $selected_enrollment);
    $this->session->set_userdata('enrollment_component', $enrollment_component);

    redirect('input_nilai');
  }

  public function insert()
  {
    $grades = $this->input->post('grades');
    $selected_enrollment = $this->session->userdata('selected_enrollment');

    foreach ($grades as $component_id => $scores) {
      foreach ($scores as $score_id => $score_value) {
        if ($score_value >= 1 && $score_value <= 100) {
          $check = $this->score->check($score_id, $selected_enrollment['enrollment_id'], $component_id);

          if ($check > 0) {
            $data = $score_value;

            $this->score->update($score_id, $selected_enrollment['enrollment_id'], $component_id, $data);
          } else {
            $data = [
              'enrollment_id' => $selected_enrollment['enrollment_id'],
              'component_id' => $component_id,
              'score' => $score_value
            ];

            $this->score->insert($data);
          }
        }
      }
    }

    $this->session->unset_userdata('selected_student');
    $this->session->unset_userdata('student_course');
    $this->session->unset_userdata('selected_enrollment');
    $this->session->unset_userdata('enrollment_component');

    if ($this->session->userdata('is_edit')) {
      $this->session->unset_userdata('is_edit');
      redirect('rekap/select');
    }

    redirect('input_nilai');
  }
}
