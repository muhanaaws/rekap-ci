<?php

class Course_model extends CI_Model
{
  private $_table = 'courses';

  public function insert($data)
  {
    return $this->db->insert($this->_table, $data);
  }

  public function get_all()
  {
    $this->db->select('courses.*, l.name as lecturer_name, COUNT(DISTINCT s.user_id) as student_count');
    $this->db->from($this->_table);
    $this->db->join('users AS l', 'l.user_id = courses.lecturer_id', 'left');
    $this->db->join('enrollments AS e', 'e.course_id = courses.course_id', 'left');
    $this->db->join('users AS s', 's.user_id = e.student_id', 'left');
    $this->db->group_by('courses.course_id, l.name');

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_all_by_student($user_id)
  {
    $this->db->select('courses.*, l.name AS lecturer_name, e.student_id');
    $this->db->from($this->_table);
    $this->db->join('enrollments AS e', 'e.course_id = courses.course_id AND e.student_id = ' . $this->db->escape($user_id), 'left');
    $this->db->join('users AS l', 'l.user_id = courses.lecturer_id', 'left');

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_enrolled($id)
  {
    $this->db->select('courses.*, e.enrollment_id, l.name AS lecturer_name');
    $this->db->from($this->_table);
    $this->db->join('enrollments AS e', 'e.course_id = courses.course_id', 'left');
    $this->db->join('users AS l', 'l.user_id = courses.lecturer_id', 'left');
    $this->db->where('e.student_id', $id);

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_one($id)
  {
    $this->db->where('course_id', $id);
    $query = $this->db->get($this->_table);
    return $query->row_array();
  }

  public function find($array)
  {
    $this->db->where($array);
    $query = $this->db->get($this->_table);
    return $query->result_array();
  }

  public function update($id, $data)
  {
    $this->db->where('course_id', $id);
    return $this->db->update($this->_table, $data);
  }

  public function delete($id)
  {
    $this->db->where('course_id', $id);
    return $this->db->delete($this->_table);
  }
}
