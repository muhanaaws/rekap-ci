<?php

class Score_model extends CI_Model
{
  private $_table = 'assessment_scores';

  public function insert($data)
  {
    return $this->db->insert($this->_table, $data);
  }

  public function check($score_id, $selected_enrollment, $component_id)
  {
    $this->db->select('score_id');
    $this->db->from($this->_table);
    $this->db->where('score_id', $score_id);
    $this->db->where('enrollment_id', $selected_enrollment);
    $this->db->where('component_id', $component_id);

    $query = $this->db->get();
    return $query->row_array();
  }

  public function update($id, $enrollment_id, $component_id, $data)
  {
    $this->db->set('score', $data);
    $this->db->where('score_id', $id);
    $this->db->where('enrollment_id', $enrollment_id);
    $this->db->where('component_id', $component_id);
    return $this->db->update($this->_table);
  }
}
