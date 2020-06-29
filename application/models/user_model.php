<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user_model extends CI_Model
{
    public function addUser($user)
    {
        $this->db->insert("users", $user);
    }

    public function getUser()
    {
        $response = $this->db->query("SELECT * FROM users")->result();
        return $response;
    }

    public function getByUser()
    {
        $response = $this->db->query("SELECT id,email FROM users WHERE email LIKE 'juan@gmail.com%' ")->result();
        return $response;
    }
}
