<?php

class User_model extends CI_Model
{
  private $_table = 'users';

  public function insert($data)
  {
    return $this->db->insert($this->_table, $data);
  }

  public function get_all()
  {
    $query = $this->db->get($this->_table);
    return $query->result_array();
  }

  public function get_all_by_lecturer($id)
  {
    $this->db->select('users.*, c.course_name');
    $this->db->from($this->_table);
    $this->db->join('enrollments AS e', 'e.student_id = users.user_id', 'left');
    $this->db->join('courses AS c', 'c.course_id = e.course_id', 'left');
    $this->db->join('users AS l', 'l.user_id = c.lecturer_id', 'left');
    $this->db->where('l.user_id', $id);

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_one($id)
  {
    $this->db->where('user_id', $id);
    $query = $this->db->get($this->_table);
    return $query->row_array();
  }

  public function find($array)
  {
    $this->db->where($array);
    $query = $this->db->get($this->_table);
    return $query->result_array();
  }

  public function find_student($role_identity)
  {
    $this->db->where('users.role_identity', $role_identity);
    $query = $this->db->get($this->_table);
    return $query->row_array();
  }

  public function find_student_grades($components, $course_id)
  {
    $this->db->select('users.* ');
    foreach ($components as $c) {
      $component_name = $c['component_name'];
      $component_id = $c['component_id'];
      if ($component_id == 'final_grade') {
        $this->db->select('g.final_grade AS Total');
      } elseif ($component_id == 'letter_grade') {
        $this->db->select('g.letter_grade AS Nilai');
      } else {
        $this->db->select("SUM(CASE WHEN ac.component_id = $component_id THEN as.score ELSE 0 END) AS `$component_name`");
      }
      // $this->db->select("SUM(CASE WHEN ac.component_id = $component_id THEN as.score ELSE 0 END) AS `$component_name`");
    }
    $this->db->select('e.enrollment_id, c.course_id, g.grade_id, g.final_grade AS Total, g.letter_grade AS Nilai');
    $this->db->from($this->_table);
    $this->db->join('enrollments e', 'users.user_id = e.student_id');
    $this->db->join('courses c', 'e.course_id = c.course_id');
    $this->db->join('assessment_components ac', 'ac.course_id = c.course_id', 'left');
    $this->db->join('assessment_scores as', 'as.enrollment_id = e.enrollment_id AND as.component_id = ac.component_id', 'left');
    $this->db->join('grades g', 'g.enrollment_id = e.enrollment_id', 'left');
    $this->db->where('c.course_id', $course_id);
    if ($this->session->userdata('role') == 'mahasiswa') {
      $this->db->where('users.user_id', $this->session->userdata('user_id'));
    }
    $this->db->group_by('users.role_identity, users.name, e.enrollment_id, g.grade_id, g.final_grade, g.letter_grade');

    $query = $this->db->get();
    return $query->result_array();
  }

  public function update($id, $data)
  {
    $this->db->where('user_id', $id);
    return $this->db->update($this->_table, $data);
  }

  public function delete($id)
  {
    $this->db->where('user_id', $id);
    return $this->db->delete($this->_table);
  }
}
