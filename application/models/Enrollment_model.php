<?php

class Enrollment_model extends CI_Model
{
  private $_table = 'enrollments';

  public function insert($data)
  {
    return $this->db->insert($this->_table, $data);
  }

  public function find_selected($user_id, $course_id)
  {
    $this->db->select('enrollments.*');
    $this->db->from($this->_table);
    $this->db->join('courses AS c', 'c.course_id = enrollments.course_id');
    $this->db->join('users AS u', 'u.user_id = enrollments.student_id');
    $this->db->where('c.course_id', $course_id);
    $this->db->where('u.user_id', $user_id);

    $query = $this->db->get();
    return $query->row_array();
  }

  public function get_score($course_id)
  {
    $this->db->select('enrollments.*, as.component_id, as.score');
    $this->db->from($this->_table);
    $this->db->join('assessment_scores AS as', 'as.enrollment_id = enrollments.enrollment_id');
    $this->db->where('enrollments.course_id', $course_id);

    $query = $this->db->get();
    return $query->result_array();
  }
}
