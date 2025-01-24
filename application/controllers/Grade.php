<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grade extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Grade_model', 'grade');
    $this->load->model('Course_model', 'course');
    $this->load->model('Assessment_model', 'assessment');
    $this->load->model('User_model', 'user');
    $this->load->model('Enrollment_model', 'enrollment');
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

    if ($data['role'] == 'admin') {
      $data['courses'] = $this->course->get_all();
    } elseif ($data['role'] == 'dosen') {
      $data['courses'] = $this->course->find(['lecturer_id' => $data['user_id']]);
    } elseif ($data['role'] == 'mahasiswa') {
      $data['courses'] = $this->course->get_enrolled($data['user_id']);
    }

    if ($this->session->userdata('course_components')) {
      $data['course_components'] = $this->session->userdata('course_components');
    } else {
      $data['course_components'] = [];
    }

    if ($this->session->userdata('selected_course')) {
      $data['selected_course'] = $this->session->userdata('selected_course');
    } else {
      $data['selected_course'] = [];
    }

    if ($this->session->userdata('students')) {
      $data['students'] = $this->session->userdata('students');
    } else {
      $data['students'] = [];
    }

    $this->load->view('templates/header', $data);
    $this->load->view('grade/index', $data);
    $this->load->view('templates/footer');
  }

  public function select_course()
  {
    $selected_course = $this->input->post('course_id') ? $this->input->post('course_id') : $this->session->userdata('selected_course');

    $course_components = $this->assessment->find($selected_course);
    $course_components[] = ['component_id' => 'final_grade', 'component_name' => 'Total'];
    $course_components[] = ['component_id' => 'letter_grade', 'component_name' => 'Nilai'];

    $students = $this->user->find_student_grades($course_components, $selected_course);

    $this->session->set_userdata('course_components', $course_components);
    $this->session->set_userdata('selected_course', $selected_course);
    $this->session->set_userdata('students', $students);

    redirect('rekap');
  }

  public function edit()
  {
    $json_data =  $this->input->post('student_data');
    $student = json_decode($json_data, true);

    $selected_student = $this->user->find_student($student['role_identity']);
    $student_course = $this->course->get_enrolled($selected_student['user_id']);

    $this->session->set_userdata('selected_student', $selected_student);
    $this->session->set_userdata('student_course', $student_course);
    $this->session->set_userdata('is_edit', true);

    redirect('input_nilai/select');
  }

  public function calculate()
  {
    $components = $this->assessment->find($this->session->userdata('selected_course'));

    $component_weights = [];
    foreach ($components as $component) {
      $component_weights[$component['component_id']] = $component['component_weight'];
    }

    $scores = $this->enrollment->get_score($this->session->userdata('selected_course'));

    $final_scores = [];
    foreach ($scores as $s) {
      $enrollment_id = $s['enrollment_id'];
      $component_id = $s['component_id'];
      $score = $s['score'];

      if (!isset($final_scores[$enrollment_id])) {
        $final_scores[$enrollment_id] = 0;
      }

      $final_scores[$enrollment_id] += $score * ($component_weights[$component_id] ?? 0);
    }

    foreach ($final_scores as $enrollment_id => $final_score) {
      $letter_grade = 'E';
      if ($final_score >= 81) {
        $letter_grade = 'A';
      } elseif ($final_score >= 61) {
        $letter_grade = 'B';
      } elseif ($final_score >= 41) {
        $letter_grade = 'C';
      } elseif ($final_score >= 21) {
        $letter_grade = 'D';
      }

      $check = $this->grade->check($enrollment_id);

      if ($check > 0) {
        $this->grade->update($enrollment_id, $final_score, $letter_grade);
      } else {
        $data = [
          'enrollment_id' => $enrollment_id,
          'final_grade' => $final_score,
          'letter_grade' => $letter_grade
        ];

        $this->grade->insert($data);
      }
    }

    redirect('rekap/select');
  }
}
