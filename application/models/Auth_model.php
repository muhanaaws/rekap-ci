<?php

class Auth_model extends CI_Model
{
  private $_table = 'users';

  public function login($identity, $password)
  {
    $user = $this->db->get_where($this->_table, ['role_identity' => $identity])->row_array();

    if ($user) {
      if (password_verify($password, $user['password'])) {
        return $user;
      }
      return false;
    }
    return false;
  }

  public function register($data)
  {
    return $this->db->insert($this->_table, $data);
  }
}
