<?php

class Dashboard extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    check_login();
    $this->load->Model(array('Model_dashboard', 'Model_absensi'));
  }

  function view_dashboard()
  {

    $data['data']       = $this->Model_absensi->getAbsensiByID();
    $data['absensi']    = $this->Model_absensi->getAbsensiLimit();
    $data['allsurat']   = $this->Model_absensi->getAllSuratAbsen();
    $data['pending']    = $this->Model_absensi->getSuratPending();
    $this->template->load('template', 'dashboard/view_dashboard', $data);
  }

  function scanQRCode()
  {

    $data['data']       = $this->Model_absensi->getAbsensiByID();
    $data['absensi']    = $this->Model_absensi->getAbsensiLimit();
    $data['allsurat']   = $this->Model_absensi->getAllSuratAbsen();
    $data['pending']    = $this->Model_absensi->getSuratPending();
    $this->load->view('absensi/scanQRCode', $data);
  }
}
