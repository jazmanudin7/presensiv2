<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Presensi</title>
    <meta name="description" content="Finapp HTML Mobile Template">
    <meta name="keywords" content="bootstrap, wallet, banking, fintech mobile template, cordova, phonegap, mobile, html, responsive" />
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/img/icon/192x192.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sweetalert2.min.css">


    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>


</head>

<body>

    <div id="loader">
        <img src="<?php echo base_url(); ?>assets/img/loading-icon.png" alt="icon" class="loading-icon">
    </div>

    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            PRESENSI MP-PCF
        </div>
        <div class="right">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#pengajuanPending">
                <ion-icon class="icon" name="notifications-outline"></ion-icon>
                <?php if ($data['pending'] != '') { ?>
                    <span class="badge badge-danger"><?php echo $data['pending']; ?></span>
                <?php } ?>
            </a>
            <a href="#" class="headerButton">
                <?php if ($data['foto'] != '') { ?>
                    <img src="<?php echo base_url(); ?>assets/img/karyawan/<?php echo $data['foto']; ?>" alt="image" class="imaged w32">
                <?php } else { ?>
                    <img src="<?php echo base_url(); ?>assets/img/pria.png" alt="image" class="imaged w32">
                <?php } ?>
                <span class="badge badge-danger"></span>
            </a>
        </div>
    </div>

    <div id="appCapsule">

        <?php echo $contents; ?>

    </div>

    <?php
    $headDept       = $data['head_dept'];
    $jmlhHead       = $this->db->query("SELECT * FROM surat_izin INNER JOIN master_karyawan ON master_karyawan.nik = surat_izin.nik WHERE surat_izin.head_dept IS NULL AND approval = '$headDept' ")->num_rows();
    $jmlhHRD        = $this->db->query("SELECT * FROM surat_izin INNER JOIN master_karyawan ON master_karyawan.nik = surat_izin.nik WHERE surat_izin.head_dept = 'Diterima' AND hrd IS NULL ")->num_rows();

    ?>
    <div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="profileBox pt-2 pb-2">
                        <div class="image-wrapper">
                            <?php if ($data['foto'] != '') { ?>
                                <img src="<?php echo base_url(); ?>assets/img/karyawan/<?php echo $data['foto']; ?>" alt="image" class="imaged  w32">
                            <?php } else { ?>
                                <img src="<?php echo base_url(); ?>assets/img/pria.png" alt="image" class="imaged  w36">
                            <?php } ?>
                        </div>
                        <div class="in">
                            <strong><?php echo $data['nama_karyawan']; ?></strong>
                            <div class="text-muted"><?php echo $data['nik']; ?></div>
                        </div>
                        <a href="#" class="btn btn-link btn-icon sidebar-close" data-bs-dismiss="modal">
                            <ion-icon name="close-outline"></ion-icon>
                        </a>
                    </div>
                    <div class="listview-title mt-1">Menu</div>
                    <ul class="listview flush transparent no-line image-listview">
                        <li>
                            <a href="<?php echo base_url(); ?>" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="home"></ion-icon>
                                </div>
                                <div class="in">
                                    Home
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>Absensi/viewAbsensi" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="phone-portrait-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Presensi
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>Absensi/SuratAbsen" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="document-text-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Surat Absen
                                </div>
                            </a>
                        </li>
                        <?php if ($data['head_dept'] != '-') { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>absensi/viewApprovalHeadDept" class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="checkmark-circle-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        Approval
                                        <?php if ($jmlhHead >= 1) { ?>
                                            <span class="badge badge-danger"><?php echo $jmlhHead; ?></span>
                                        <?php } ?>
                                    </div>
                                </a>
                            </li>
                        <?php } else if ($data['head_dept'] != '-') { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>absensi/viewApprovalHRD" class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="checkmark-circle-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        Approval
                                        <?php if ($jmlhHRD >= 1) { ?>
                                            <span class="badge badge-danger"><?php echo $jmlhHRD; ?></span>
                                        <?php } ?>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="listview-title mt-1">Others</div>
                    <ul class="listview flush transparent no-line image-listview">
                        <li>
                            <a href="#" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="settings-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Settings
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="chatbubble-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Support
                                </div>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade action-sheet" id="pengajuanPending" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Surat Absen Pending</h5>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content">
                        <div class="transactions">
                            <?php foreach ($pending as $a) {
                            ?>
                                <a href="<?php echo base_url(); ?>absensi/SuratAbsen" class="item">
                                    <div class="detail">
                                        <?php
                                        if ($a->keterangan == 'Sakit') {
                                            $icon   = "S.png";
                                        } else if ($a->keterangan == 'SID') {
                                            $icon   = "SID.png";
                                        } else if ($a->keterangan == 'Cuti') {
                                            $icon   = "C.png";
                                        } else if ($a->keterangan == 'Izin') {
                                            $icon   = "I.png";
                                        } else {
                                            $icon   = "A.png";
                                        }
                                        ?>
                                        <img src="<?php echo base_url(); ?>assets/img/icon/<?php echo $icon; ?>" alt="img" class="image-block imaged w48">
                                        <div>
                                            <strong><?php echo $a->nama_karyawan; ?></strong>
                                            <p><?php echo $a->keterangan; ?></p>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="price"><?php echo $a->tanggal; ?></div>
                                        <p class="<?php if ($a->hrd != 'Diterima') {
                                                        echo "text-danger";
                                                    } else {
                                                        echo "text-success";
                                                    } ?>"><?php if ($a->hrd != 'Diterima') {
                                                                echo "Pending";
                                                            } else {
                                                                echo "Diterima";
                                                            } ?></p>
                                    </div>
                                </a>
                            <?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="appBottomMenu">
        <a href="<?php echo base_url(); ?>" id="homenav" class="item">
            <div class="col">
                <ion-icon name="home-outline"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>Absensi/viewAbsensi" id="kehadiran" class="item">
            <div class="col">
                <ion-icon name="phone-portrait-outline"></ion-icon>
                <strong>Kehadiran</strong>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>Absensi/SuratAbsen" id="suratabsen" class="item">
            <div class="col">
                <ion-icon name="document-text-outline"></ion-icon>
                <strong>Surat Absen</strong>
            </div>
        </a>
        <?php if ($data['head_dept'] != '-') { ?>
            <a href="<?php echo base_url(); ?>Absensi/viewApprovalHeadDept" id="approvalheaddept" class="item">
                <div class="col">
                    <ion-icon name="checkmark-circle-outline"></ion-icon>
                    <strong>Approval</strong>
                    <?php if ($jmlhHead >= 1) { ?>
                        <span class="badge badge-danger"><?php echo $jmlhHead; ?></span>
                    <?php } ?>
                </div>
            </a>
        <?php } ?>

        <?php if ($data['nik'] == '14.06.035') { ?>
            <a href="<?php echo base_url(); ?>Absensi/viewApprovalHRD" id="approvalhrd" class="item">
                <div class="col">
                    <ion-icon name="checkmark-circle-outline"></ion-icon>
                    <strong>Approval</strong>
                    <?php if ($jmlhHRD >= 1) { ?>
                        <span class="badge badge-danger"><?php echo $jmlhHRD; ?></span>
                    <?php } ?>
                </div>
            </a>
        <?php } ?>
        <a href="<?php echo base_url(); ?>Absensi/viewProfile" id="profile" class="item">
            <div class="col">
                <ion-icon name="person-outline"></ion-icon>
                <strong>Profile</strong>
            </div>
        </a>
    </div>

    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/splide/splide.min.js"></script>
    <!-- Base Js File -->
    <script src="<?php echo base_url(); ?>assets/js/base.js"></script>

    <!-- Sweat Alert 2 -->
    <script src="<?php echo base_url(); ?>assets/js/sweetalert2.min.js"></script>

    <script>
        AddtoHome("2000", "once");
    </script>


</body>

</html>