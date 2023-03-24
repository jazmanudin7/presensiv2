<?php

class Absensi extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    check_login();
    $this->load->Model('Model_absensi');
  }
  
  function updateFoto(){
   
   
    $nik            = $this->session->userdata('nik');
    $foto           = $this->db->query("SELECT foto FROM karyawan 
    WHERE karyawan.nik = '$nik' ")->row_array();
    
    unlink('./assets/img/karyawan/'.$foto['foto']);
	$config['upload_path'] 			= './assets/img/karyawan';
	$config['allowed_types']    	= 'gif|jpg|png|jpeg|bmp|pdf';
	$config['file_name']       		= $this->input->post('nik');
	$this->upload->initialize($config);
	if ($this->upload->do_upload('foto')) {
		$_data                     	= array('upload_data' => $this->upload->data());
		$foto                      	= $_data['upload_data']['file_name'];
		$this->load->library('upload', $config);
	    $data = array(

            'foto'                 => $foto,
        
        );
        
        $this->db->where('nik', $nik);
        $this->db->update('karyawan', $data);
        redirect('Absensi/viewProfile');
	}
  }

  function viewProfile()
  {
      
    $data['data']       = $this->Model_absensi->getAbsensiByID();
    $data['kry']        = $this->Model_absensi->getKaryawan();
    $data['pending']    = $this->Model_absensi->getSuratPending();
    $this->template->load('template','absensi/viewProfile',$data);
  }

  function AbsensiMasuk()
  {
     
    $data['data']       = $this->Model_absensi->getAbsensiByID();
    $data['pending']    = $this->Model_absensi->getSuratPending();
    $this->template->load('template','absensi/AbsensiMasuk',$data);
    
  }

  function AbsensiPulang()
  {
     
    $data['data']       = $this->Model_absensi->getAbsensiByID();
    $data['pending']    = $this->Model_absensi->getSuratPending();
    $this->template->load('template','absensi/AbsensiPulang',$data);
    
  }

  function SuratAbsen()
  {
     
    $data['data']       = $this->Model_absensi->getAbsensiByID();
    $data['pending']    = $this->Model_absensi->getSuratPending();
    $this->template->load('template','absensi/SuratAbsen',$data);
    
  }

  function viewApprovalHeadDept()
  {
     
    $data['absensi']    = $this->Model_absensi->getApprovalHeadDept();
    $data['suratabsen'] = $this->Model_absensi->getSuratAbsenByID();
    $data['data']       = $this->Model_absensi->getAbsensiByID();
    $data['pending']    = $this->Model_absensi->getSuratPending();
    $this->template->load('template','absensi/viewApprovalHeadDept',$data);
    
  }
  
  function viewApprovalHRD()
  {
     
    $data['absensi']    = $this->Model_absensi->getApprovalHRD();
    $data['data']       = $this->Model_absensi->getAbsensiByID();
    $data['pending']    = $this->Model_absensi->getSuratPending();
    $this->template->load('template','absensi/viewApprovalHRD',$data);
    
  }

  function viewSuratAbsen()
  {
    
    
    $data['surat']   = $this->Model_absensi->getSuratAbsen();
    $this->load->view('absensi/viewSuratAbsen',$data);
    
  }

  function viewAbsensi()
  {
     
    $data['data']       = $this->Model_absensi->getAbsensiByID();
    $data['pending']    = $this->Model_absensi->getSuratPending();
    $this->template->load('template','absensi/viewAbsensi',$data);
    
  }

  function viewDetailAbsensi()
  {
    
    
    $data['absensi']   = $this->Model_absensi->getAbsensi();
    $this->load->view('absensi/viewDetailAbsensi',$data);
    
  }

  function detailPresensi()
  {
    
    
    $data['data']   = $this->Model_absensi->detailPresensi();
    $this->load->view('absensi/detailPresensi',$data);
    
  }

  function viewDetailSuratAbsen()
  {
    
    
    $data['suratabsen']     = $this->Model_absensi->getSuratAbsenByID();
    $data['pending']        = $this->Model_absensi->getSuratPending();
    $this->load->view('absensi/viewDetailSuratAbsen',$data);
    
  }

  function viewDetailApproval()
  {
    
    
    $data['suratabsen']     = $this->Model_absensi->getSuratAbsenByID();
    $data['pending']        = $this->Model_absensi->getSuratPending();
    $this->load->view('absensi/viewDetailApproval',$data);
    
  }

  function simpanSurat()
  {
      
    $this->Model_absensi->simpanSurat();
    
  }

  function InsertAbsenMasuk()
  {
      
    $this->Model_absensi->InsertAbsenMasuk();
    
  }

  function updateShift()
  {
      
    $this->Model_absensi->updateShift();
    
  }

  function UpdateAbsenPulang()
  {
      
    $this->Model_absensi->UpdateAbsenPulang();
    
  }

  function approval()
  {
      
    $this->Model_absensi->approval();
    
  }

  function hapusSurat()
  {
      
    $kode_surat     = $this->input->post('kode_surat');
    $this->db->query("DELETE FROM surat_izin WHERE kode_surat = '$kode_surat' ");
    
  }
  
}
