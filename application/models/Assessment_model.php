<?php

class Assessment_model extends CI_Model
{
  private $_table = 'assessment_components';

  public function insert($data)
  {
    return $this->db->insert($this->_table, $data);
  }

  public function get_all()
  {
    $this->db->select('assessment_components.*, c.course_id, c.course_code, c.course_name');
    $this->db->from($this->_table);
    $this->db->join('courses AS c', 'c.course_id = assessment_components.course_id');

    $query = $this->db->get();
    return $query->result_array();
  }

  public function find($course_id)
  {
    $this->db->where('course_id', $course_id);
    $query = $this->db->get($this->_table);
    return $query->result_array();
  }

  public function find_selected($enrollment_id, $course_id)
  {
    $this->db->select('assessment_components.*, c.course_id, c.course_code, c.course_name, a.score_id, a.score');
    $this->db->from($this->_table);
    $this->db->join('courses AS c', 'c.course_id = assessment_components.course_id');
    $this->db->join('assessment_scores AS a', 'a.component_id = assessment_components.component_id AND a.enrollment_id = ' . $this->db->escape($enrollment_id), 'left');
    $this->db->where('c.course_id', $course_id);

    $query = $this->db->get();
    return $query->result_array();
  }

  public function update($id, $data)
  {
    $this->db->where('component_id', $id);
    return $this->db->update($this->_table, $data);
  }

  public function delete($id)
  {
    $this->db->where('component_id', $id);
    return $this->db->delete($this->_table);
  }
}
