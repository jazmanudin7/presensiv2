<?php

class Model_auth extends CI_Model
{

  function cek_nik()
  {

    $nik       = $this->input->post('nik');
    echo $this->db->query("SELECT nik FROM master_karyawan
    WHERE nik = '$nik' ")->num_rows();
  }
  
  function cek_user($email = null, $password = null)
  {

    return $this->db->query("SELECT * FROM master_karyawan
    WHERE email = '$email'  AND password = '$password'  ");
  }
  
  function insertRegistrasi()
  {

    $nik            = $this->input->post('nik');
    $email          = $this->input->post('email');
    $password       = $this->input->post('password');

    $data = array(

      'nik'                 => $nik,
      'email'               => $email,
      'password'            => $password,
      'shift'               => "Non Shift",
      'status'              => "Aktif",
      'head_dept'           => "-",
      'hrd'                 => "-",
      'security'            => "-",
      'lihat_lokasi'        => "Tidak Aktif",
      'lokasi'              => "Tidak Aktif",

    );

    $this->db->insert('akun', $data);
  }
  
}
