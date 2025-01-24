<?php

class Grade_model extends CI_Model
{
  private $_table = 'grades';

  public function check($enrollment_id)
  {
    $this->db->select('grade_id');
    $this->db->from($this->_table);
    $this->db->where('enrollment_id', $enrollment_id);

    $query = $this->db->get();
    return $query->row_array();
  }

  public function insert($data)
  {
    return $this->db->insert($this->_table, $data);
  }

  public function update($id, $final_score, $letter_grade)
  {
    $this->db->set('final_grade', $final_score);
    $this->db->set('letter_grade', $letter_grade);
    $this->db->where('enrollment_id', $id);
    return $this->db->update($this->_table);
  }
}
