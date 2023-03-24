<?php

class Model_absensi extends CI_Model
{


    function getKaryawan()
    {

        $nik            = $this->session->userdata('nik');
        return $this->db->query("SELECT * FROM master_karyawan 
        WHERE master_karyawan.nik = '$nik' ")->row_array();
    }

    function getAbsensiByID()
    {

        $tanggal        = Date('Y-m-d');
        $tahun          = Date('Y');
        $nik            = $this->session->userdata('nik');
        return $this->db->query("SELECT master_karyawan.nik,id_kantor,nama_karyawan,master_karyawan.head_dept,absn.masuk,absn.pulang,absn.kode_absensi,absn.keterangan,trlmb.nonshift,trlmb.shift1,trlmb.shift2,trlmb.shift3,
        suratabsen.alfa,suratabsen.sakit,suratabsen.izin,suratabsen.cuti,suratabsen.sid,suratabsen.pending,master_karyawan.foto FROM master_karyawan 
        LEFT JOIN (
            SELECT absensi.nik,masuk,pulang,keterangan,kode_absensi
        FROM absensi
        WHERE absensi.tanggal = '$tanggal' AND nik = '$nik' ) absn ON (absn.nik=master_karyawan.nik)
        LEFT JOIN (
            SELECT absensi.nik,
            COUNT(CASE WHEN shift = 'Non Shift' AND masuk >= '08:05:00' THEN '' END) AS nonshift,
            COUNT(CASE WHEN shift = 'Shift 1' AND masuk >= '07:05:00' THEN '' END) AS shift1,
            COUNT(CASE WHEN shift = 'Shift 2' AND masuk >= '15:05:00' THEN '' END) AS shift2,
            COUNT(CASE WHEN shift = 'Shift 3' AND masuk >= '23:05:00' THEN '' END) AS shift3
        FROM absensi
        WHERE nik = '$nik' AND YEAR(absensi.tanggal) = '$tahun') trlmb ON (trlmb.nik=master_karyawan.nik)
        LEFT JOIN absensi ON master_karyawan.nik = absensi.nik
        LEFT JOIN (
            SELECT nik,
            COUNT(CASE WHEN keterangan = 'Alfa' AND surat_izin.hrd = 'Diterima' THEN '' END) AS alfa,
            COUNT(CASE WHEN keterangan = 'Sakit' AND surat_izin.hrd = 'Diterima' THEN '' END) AS sakit,
            COUNT(CASE WHEN keterangan = 'Izin' AND surat_izin.hrd = 'Diterima' THEN '' END) AS izin,
            COUNT(CASE WHEN keterangan = 'Cuti' AND surat_izin.hrd = 'Diterima' THEN '' END) AS cuti,
            COUNT(CASE WHEN keterangan = 'SID' AND surat_izin.hrd = 'Diterima' THEN '' END) AS sid,
            COUNT(CASE WHEN hrd IS NULL THEN '' END) AS pending
            FROM surat_izin
        WHERE YEAR(surat_izin.tanggal) = '$tahun' AND nik = '$nik' 
        ) suratabsen ON (suratabsen.nik=master_karyawan.nik)
        WHERE master_karyawan.nik = '$nik' ")->row_array();
    }

    function getSuratPending()
    {

        $nik            = $this->session->userdata('nik');
        return $this->db->query("SELECT *,surat_izin.tanggal FROM surat_izin 
        INNER JOIN master_karyawan ON master_karyawan.nik = surat_izin.nik
        WHERE surat_izin.nik = '$nik' AND hrd IS NULL
        ORDER BY tanggal DESC
        ")->result();
    }

    function getAllSuratAbsen()
    {
        $tahun          = Date('Y');
        $nik            = $this->session->userdata('nik');
        return $this->db->query("SELECT *,surat_izin.tanggal FROM surat_izin 
        INNER JOIN master_karyawan ON master_karyawan.nik = surat_izin.nik
        WHERE surat_izin.nik = '$nik' AND YEAR(surat_izin.tanggal) = '$tahun'
        ORDER BY tanggal DESC
        ")->result();
    }

    function getSuratAbsenByID()
    {
        $kode_surat     = $this->input->post('kode_surat');

        return $this->db->query("SELECT *,surat_izin.head_dept FROM surat_izin 
        INNER JOIN master_karyawan ON master_karyawan.nik = surat_izin.nik
        WHERE surat_izin.kode_surat = '$kode_surat'
        ")->row_array();
    }

    function getApprovalHeadDept()
    {
        return $this->db->query("SELECT * FROM surat_izin 
        INNER JOIN master_karyawan ON master_karyawan.nik = surat_izin.nik
        WHERE surat_izin.head_dept IS NULL
        ")->result();
    }

    function getApprovalHRD()
    {
        return $this->db->query("SELECT * FROM surat_izin 
        INNER JOIN master_karyawan ON master_karyawan.nik = surat_izin.nik
        WHERE surat_izin.hrd IS NULL AND surat_izin.head_dept = 'Diterima'
        ")->result();
    }

    function detailPresensi()
    {
        $kode_absensi     = $this->input->post('kode_absensi');

        return $this->db->query("SELECT * FROM absensi
        WHERE absensi.kode_absensi = '$kode_absensi'
        ")->row_array();
    }

    function getSuratAbsen()
    {
        $bulan          = $this->input->post("bulan");
        $tahun          = $this->input->post("tahun");

        if ($tahun != '') {
            $tahun = "AND YEAR(surat_izin.tanggal) = '$tahun'";
        }

        if ($bulan != '') {
            $bulan = "AND MONTH(surat_izin.tanggal) = '$bulan'";
        }

        $nik            = $this->session->userdata('nik');
        return $this->db->query("SELECT * FROM surat_izin 
        INNER JOIN master_karyawan ON master_karyawan.nik = surat_izin.nik
        WHERE surat_izin.nik = '$nik' "
            . $bulan
            . $tahun
            . "
        ORDER BY tanggal DESC
        ")->result();
    }

    function getAbsensiLimit()
    {

        $bulan          = Date('m');
        $tahun          = Date('Y');
        $nik            = $this->session->userdata('nik');
        return $this->db->query("SELECT *,(CASE 
            WHEN shift = 'Non Shift' THEN timediff(masuk,'08:05:00')
            WHEN shift = 'Shift 1' THEN timediff(masuk,'07:05:00')
            WHEN shift = 'Shift 2' THEN timediff(masuk,'15:05:00')
            WHEN shift = 'Shift 3' THEN timediff(masuk,'23:05:00')
            ELSE 'Tidak Terlambat'
        END) AS terlambat FROM absensi 
        INNER JOIN master_karyawan ON master_karyawan.nik = absensi.nik
        WHERE absensi.nik = '$nik'
        ORDER BY absensi.tanggal DESC
        LIMIT 5
        ")->result();
    }

    function getAbsensi()
    {
        $bulan          = $this->input->post("bulan");
        $tahun          = $this->input->post("tahun");

        $nik            = $this->session->userdata('nik');
        return $this->db->query("SELECT *,(CASE 
                WHEN shift = 'Non Shift' THEN timediff(masuk,'08:05:00')
                WHEN shift = 'Shift 1' THEN timediff(masuk,'07:05:00')
                WHEN shift = 'Shift 2' THEN timediff(masuk,'15:05:00')
                WHEN shift = 'Shift 3' THEN timediff(masuk,'23:05:00')
                ELSE 'Tidak Terlambat'
            END) AS terlambat
        FROM absensi
        INNER JOIN master_karyawan ON master_karyawan.nik = absensi.nik
        WHERE absensi.nik = '$nik' AND YEAR(absensi.tanggal) = '$tahun' AND MONTH(absensi.tanggal) = '$bulan'
        ORDER BY absensi.tanggal DESC
        ")->result();
    }


    function simpanSurat()
    {

        $nik            = $this->session->userdata('nik');
        $kode_surat     = $this->input->post('kode_surat');
        $deskripsi      = $this->input->post('deskripsi');
        $jenis_surat    = $this->input->post('jenis_surat');
        $dari           = $this->input->post('dari');
        $sampai         = $this->input->post('sampai');

        if ($kode_surat != '') {
            $this->db->query("DELETE FROM surat_izin WHERE kode_surat = '$kode_surat' ");
        }

        if ($jenis_surat == 'Izin Tidak Masuk Kerja') {

            while (strtotime($dari) <= strtotime($sampai)) {

                $this->db->query("INSERT INTO surat_izin (nik, judul, tanggal, keterangan, isi, foto, jenis_izin) VALUES ('$nik', 'Izin Tidak Masuk Kerja', '$dari', 'Izin', '$deskripsi', '', 'Izin Tidak Masuk Kerja' )");

                $dari = date("Y-m-d", strtotime("+1 day", strtotime($dari)));
            }
        } else if ($jenis_surat == 'Izin Kepentingan Pribadi (Sebentar)') {

            $this->db->query("INSERT INTO surat_izin (nik, judul, tanggal, keterangan, isi, foto, jenis_izin) VALUES ('$nik', 'Izin Kepentingan Pribadi (Sebentar)', '$dari', 'Izin', '$deskripsi', '', 'Izin Kepentingan Pribadi (Sebentar)' )");
        } else if ($jenis_surat == 'Izin Kepentingan Pribadi (Pulang)') {

            $this->db->query("INSERT INTO surat_izin (nik, judul, tanggal, keterangan, isi, foto, jenis_izin) VALUES ('$nik', 'Izin Kepentingan Pribadi (Pulang)', '$dari', 'Izin', '$deskripsi', '', 'Izin Kepentingan Pribadi (Pulang)' )");
        } else if ($jenis_surat == 'Izin Kepentingan Kantor') {

            while (strtotime($dari) <= strtotime($sampai)) {

                $this->db->query("INSERT INTO surat_izin (nik, judul, tanggal, keterangan, isi, foto, jenis_izin) VALUES ('$nik', 'Izin Kepentingan Kantor', '$dari', 'Izin', '$deskripsi', '', 'Izin Kepentingan Kantor' )");

                $dari = date("Y-m-d", strtotime("+1 day", strtotime($dari)));
            }
        } else if ($jenis_surat == 'Sakit (Pulang)') {

            $this->db->query("INSERT INTO surat_izin (nik, judul, tanggal, keterangan, isi, foto, jenis_izin) VALUES ('$nik', 'Sakit (Pulang)', '$dari', 'Sakit', '$deskripsi', '', 'Sakit (Pulang)' )");
        } else if ($jenis_surat == 'Sakit Tanpa SID') {

            while (strtotime($dari) <= strtotime($sampai)) {

                $this->db->query("INSERT INTO surat_izin (nik, judul, tanggal, keterangan, isi, foto, jenis_izin) VALUES ('$nik', 'Sakit Tanpa SID', '$dari', 'Sakit', '$deskripsi', '', 'Sakit Tanpa SID' )");

                $dari = date("Y-m-d", strtotime("+1 day", strtotime($dari)));
            }
        } else if ($jenis_surat == 'Sakit Dengan SID') {

            while (strtotime($dari) <= strtotime($sampai)) {

                $this->db->query("INSERT INTO surat_izin (nik, judul, tanggal, keterangan, isi, foto, jenis_izin) VALUES ('$nik', 'Sakit Dengan SID', '$dari', 'SID', '$deskripsi', '', 'Sakit Dengan SID' )");

                $dari = date("Y-m-d", strtotime("+1 day", strtotime($dari)));
            }
        } else if ($jenis_surat == 'Cuti Tahunan') {

            while (strtotime($dari) <= strtotime($sampai)) {

                $this->db->query("INSERT INTO surat_izin (nik, judul, tanggal, keterangan, isi, foto, jenis_izin) VALUES ('$nik', 'Cuti Tahunan', '$dari', 'Cuti', '$deskripsi', '', 'Cuti Tahunan' )");

                $dari = date("Y-m-d", strtotime("+1 day", strtotime($dari)));
            }
        } else if ($jenis_surat == 'Cuti Melahirkan/Keguguran') {

            while (strtotime($dari) <= strtotime($sampai)) {

                $this->db->query("INSERT INTO surat_izin (nik, judul, tanggal, keterangan, isi, foto, jenis_izin) VALUES ('$nik', 'Cuti Melahirkan/Keguguran', '$dari', 'Cuti Lahiran', '$deskripsi', '', 'Cuti Melahirkan/Keguguran' )");

                $dari = date("Y-m-d", strtotime("+1 day", strtotime($dari)));
            }
        } else if ($jenis_surat == 'Cuti Khusus Sesuai (PP)') {

            while (strtotime($dari) <= strtotime($sampai)) {

                $this->db->query("INSERT INTO surat_izin (nik, judul, tanggal, keterangan, isi, foto, jenis_izin) VALUES ('$nik', 'Izin Khusus Sesuai (PP)', '$dari', 'Izin Khusus', '$deskripsi', '', 'Izin Khusus Sesuai (PP)' )");

                $dari = date("Y-m-d", strtotime("+1 day", strtotime($dari)));
            }
        }
    }

    function InsertAbsenMasuk()
    {

        $nik            = $this->session->userdata('nik');
        $shift          = $this->input->post('shift');
        $latitude       = $this->input->post('latitude');
        $longitude      = $this->input->post('longitude');

        $data = array(

            'nik'                     => $nik,
            'tanggal'                 => Date('Y-m-d'),
            'masuk'                   => Date('H:i:s'),
            'keterangan'              => "H",
            'shift'                   => $shift,
            'latitude_masuk'          => $latitude,
            'longitude_masuk'         => $longitude,

        );

        $this->db->insert('absensi', $data);
    }

    function UpdateAbsenPulang()
    {

        $nik            = $this->session->userdata('nik');
        $tanggal        = date('Y-m-d', strtotime('-1 days', strtotime(Date('Y-m-d'))));
        $kode_absensi   = $this->input->post('kode_absensi');
        $shift          = $this->input->post('shift');
        $latitude       = $this->input->post('latitude');
        $longitude      = $this->input->post('longitude');

        $data = array(

            'pulang'                  => Date('H:i:s'),
            'latitude_pulang'         => $latitude,
            'longitude_pulang'        => $longitude,

        );

        if ($shift == 'Shift 3') {
            $this->db->where('nik', $nik);
            $this->db->where('tanggal', $tanggal);
            $this->db->update('absensi', $data);
        } else {
            $this->db->where('kode_absensi', $kode_absensi);
            $this->db->update('absensi', $data);
        }
    }

    function updateShift()
    {

        $kode_absensi   = $this->input->post('kode_absensi');
        $shift          = $this->input->post('shift');

        $data = array(

            'shift'        => $shift,

        );

        $this->db->where('kode_absensi', $kode_absensi);
        $this->db->update('absensi', $data);
    }

    function approval()
    {

        $kode_surat     = $this->input->post('kode_surat');
        $jenis_approval = $this->input->post('jenis_approval');
        $status         = $this->input->post('status');

        if ($jenis_approval == 'Head Dept') {
            $this->db->query("UPDATE surat_izin SET surat_izin.head_dept = '$status' WHERE kode_surat = '$kode_surat'  ");
            redirect('absensi/viewApprovalHeadDept');
        } else {
            $this->db->query("UPDATE surat_izin SET hrd = '$status' WHERE kode_surat = '$kode_surat'  ");
            redirect('absensi/viewApprovalHRD');
        }
    }
}
