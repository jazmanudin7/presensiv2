<?php

class Auth extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->Model('Model_auth');
  }


  function login()
  {
    $this->load->view('auth/login');
  }

  function InsertLogin()
  {

    if (isset($_COOKIE['nik']) && isset($_COOKIE['key'])) {

      $nik = $_COOKIE['nik'];
      $key = $_COOKIE['key'];

      $data_user = $this->db->query("SELECT * FROM master_karyawan WHERE nik = '$nik' ")->row_array();

      if ($key == hash('sha256', $data_user['email'])) {
        $data_session = array(

          'nik'             => $data_user['nik'],
          'email'           => $data_user['email'],
          'shift'           => $data_user['shift'],
          'nama_lengkap'    => $data_user['nama_karyawan'],
          'group'           => $data_user['group'],
          'dept'            => $data_user['departemen'],
          'kantor'          => $data_user['kantor'],
          'departemen'      => $data_user['head_dept'],
          'akses_web'       => $data_user['akses_web'],
          'jabatan'         => $data_user['jabatan'],
          'level'           => $data_user['level'],
        );
        $this->session->set_userdata($data_session);
      } else {
        redirect('auth/login');
      }
    }

    if ($this->session->userdata('nik') != '') {
      redirect('dashboard/view_dashboard');
    }

    $email       = $this->input->post('email');
    $password    = $this->input->post('password');
    $user        = $this->Model_auth->cek_user($email, $password);
    $cek_user    = $user->num_rows();
    $data_user   = $user->row_array();

    if ($cek_user != 0) {

      $data_session = array(

        'nik'             => $data_user['nik'],
        'email'           => $data_user['email'],
        'shift'           => $data_user['shift'],
        'nama_lengkap'    => $data_user['nama_karyawan'],
        'group'           => $data_user['group'],
        'dept'            => $data_user['departemen'],
        'kantor'          => $data_user['kantor'],
        'departemen'      => $data_user['head_dept'],
        'akses_web'       => $data_user['akses_web'],
        'jabatan'         => $data_user['jabatan'],
        'level'           => $data_user['level'],
      );
      $this->session->set_userdata($data_session);

      setcookie('nik', $data_user['nik'], time() + 10 * 365 * 24 * 60 * 60);
      setcookie('key', hash('sha256', $data_user['email']), time() + 10 * 365 * 24 * 60 * 60);

      redirect('dashboard/view_dashboard');
    } else {
      redirect('auth/login');
    }
  }


  function insertRegistrasi()
  {
    $this->Model_auth->insertRegistrasi();
  }

  function cek_nik()
  {
    $this->Model_auth->cek_nik();
  }

  function cek_user()
  {
    $email       = $this->input->post('email');
    $password    = $this->input->post('password');
    $user        = $this->Model_auth->cek_user($email, $password);
    echo $user->num_rows();
  }

  function registrasi()
  {
    $this->load->view('auth/registrasi');
  }

  function logout()
  {

    session_start();
    session_unset();
    session_destroy();

    setcookie('nik', '', time() - 3600);
    setcookie('key', '', time() - 3600);


    redirect('dashboard/view_dashboard');
  }
}
