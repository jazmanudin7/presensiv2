<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>

<style>
    .badge {
        min-width: 16px;
        height: 16px;
        line-height: 9px !important;
        font-size: 10px;
        padding: 0 4px !important;
        position: relative;
        right: 0px;
        top: 10px;
    }

    #map {
        height: 200px;
    }
</style>
<div class="section wallet-card-section pt-1">
    <div class="wallet-card">
        <!-- Balance -->
        <div class="balance">
            <div class="left">
                <span class="title">Selamat Datang,</span>
                <h3><?php echo $data['nama_karyawan']; ?></h3>
            </div>
        </div>
        <!-- * Balance -->
        <!-- Wallet Footer -->
        <div class="wallet-footer">

            <div class="item">
                <span class="badge badge-danger"><?php if ($data['cuti'] != '') {
                                                        echo $data['cuti'];
                                                    } else {
                                                        echo "0";
                                                    } ?></span>
                <a href="#" data-bs-toggle="modal" data-bs-target="#rekapCuti">
                    <div class="icon-wrapper" style="background-color:#0f8647">
                        <img src="<?php echo base_url(); ?>assets/img/icon/C.png" alt="image" class="imaged w32">
                    </div>
                    <strong>Cuti</strong>
                </a>
            </div>
            <div class="item">
                <span class="badge badge-danger"><?php if ($data['sid'] != '') {
                                                        echo $data['sid'];
                                                    } else {
                                                        echo "0";
                                                    } ?></span>
                <a href="#" data-bs-toggle="modal" data-bs-target="#rekapSID">
                    <div class="icon-wrapper" style="background-color:#0f8647">
                        <img src="<?php echo base_url(); ?>assets/img/icon/SID.png" alt="image" class="imaged w32">
                    </div>
                    <strong>SID</strong>
                </a>
            </div>
            <div class="item">
                <span class="badge badge-danger"><?php if ($data['sakit'] != '') {
                                                        echo $data['sakit'];
                                                    } else {
                                                        echo "0";
                                                    } ?></span>
                <a href="#" data-bs-toggle="modal" data-bs-target="#rekapSakit">
                    <div class="icon-wrapper" style="background-color:#0f8647">
                        <img src="<?php echo base_url(); ?>assets/img/icon/S.png" alt="image" class="imaged w32">
                    </div>
                    <strong>Sakit</strong>
                </a>
            </div>
            <div class="item">
                <span class="badge badge-danger"><?php if ($data['izin'] != '') {
                                                        echo $data['izin'];
                                                    } else {
                                                        echo "0";
                                                    } ?></span>
                <a href="#" data-bs-toggle="modal" data-bs-target="#rekapIzin">
                    <div class="icon-wrapper" style="background-color:#0f8647">
                        <img src="<?php echo base_url(); ?>assets/img/icon/I.png" alt="image" class="imaged w32">
                    </div>
                    <strong>Izin</strong>
                </a>
            </div>
            <div class="item">
                <span class="badge badge-danger"><?php if ($data['alfa'] != '') {
                                                        echo $data['alfa'];
                                                    } else {
                                                        echo "0";
                                                    } ?></span>
                <a href="#" data-bs-toggle="modal" data-bs-target="#rekapAlfa">
                    <div class="icon-wrapper" style="background-color:#0f8647">
                        <img src="<?php echo base_url(); ?>assets/img/icon/A.png" alt="image" class="imaged w32">
                    </div>
                    <strong>Alfa</strong>
                </a>
            </div>
            <div class="item">
                <span class="badge badge-danger"><?php echo $data['nonshift'] + $data['shift1'] + $data['shift2'] + $data['shift3']; ?></span>
                <a href="#">
                    <div class="icon-wrapper" style="background-color:#0f8647">
                        <img src="<?php echo base_url(); ?>assets/img/icon/T.png" alt="image" class="imaged w32">
                    </div>
                    <strong>Terlambat</strong>
                </a>
            </div>
        </div>
        <!-- * Wallet Footer -->
    </div>
</div>


<div class="section" style="text-align:center ;">
    <div class="row mt-2">
        <div class="wallet-footer">
            <div id="map"></div>
        </div>
    </div>
</div>

<!-- Wallet Card -->
<div class="section" style="text-align:center ;">
    <div class="row mt-2">
        <div class="col-6">
            <a href="#" data-bs-toggle="modal" data-bs-target="#scanMasuk">
                <div class="stat-box">
                    <div style="color:black;" class="title">Scan Masuk</div>
                    <div class="value text-success"><?php if ($data['masuk'] != '') {
                                                        echo $data['masuk'];
                                                    } else {
                                                        echo "Belum Scan";
                                                    } ?></div>
                </div>
            </a>
        </div>
        <div class="col-6">
            <a href="#" data-bs-toggle="modal" data-bs-target="#scanPulang">
                <div class="stat-box">
                    <div style="color:black;" class="title">Scan Pulang</div>
                    <div class="value text-danger"><?php if ($data['pulang'] != '') {
                                                        echo $data['pulang'];
                                                    } else {
                                                        echo "Belum Scan";
                                                    } ?></div>
                </div>
            </a>
        </div>
    </div>
</div>


<!-- Transactions -->
<div class="section mt-4">
    <div class="section-heading">
        <h2 class="title">5 Hari Terakhir</h2>
        <a href="<?php echo base_url(); ?>Absensi/viewAbsensi" class="link">Lihat Semua</a>
    </div>
    <div class="transactions">
        <?php foreach ($absensi as $s) { ?>
            <a href="#" class="item detailPresensi" data-id="<?php echo $s->kode_absensi; ?>" style="background-color:<?php if ($s->pulang == '') {
                                                                                                                            echo "#ea9797";
                                                                                                                        } ?>">
                <div class="detail">
                    <img src="<?php echo base_url(); ?>assets/img/icon/H.png" alt="img" class="image-block imaged w48">
                    <div>
                        <strong><?php echo DateToIndo($s->tanggal); ?></strong>
                        <p class="text-primary"><?php if ($s->masuk != '') {
                                                    echo $s->masuk;
                                                } else {
                                                    echo "Belum Scan Masuk";
                                                } ?> - <?php if ($s->pulang != '') {
                                                            echo $s->pulang;
                                                        } else {
                                                            echo "Belum Pulang";
                                                        } ?></p>
                    </div>
                </div>
                <div class="right">
                    <div class="price"><?php echo $s->shift; ?></div>
                    <p style="color:<?php if (substr($s->terlambat, 0, 1) != '-') {
                                        echo "red";
                                    } ?>"><?php if (substr($s->terlambat, 0, 1) != '-') {
                                                echo substr($s->terlambat, 0, 8);
                                            } ?></p>
                </div>
            </a>
        <?php } ?>
    </div>
</div>
<br>
<div class="appFooter">
    <div class="footer-title">
        Develover By Jazmanudin
    </div>
    WA : 089523888200
</div>

<div class="modal fade action-sheet" id="rekapCuti" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Cuti</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="transactions">
                        <?php foreach ($allsurat as $a) {
                            if ($a->keterangan == 'Cuti') {
                        ?>
                                <a href="#" class="item">
                                    <div class="detail">
                                        <?php
                                        if ($a->keterangan == 'Cuti') {
                                            $icon   = "C.png";
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
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade action-sheet" id="rekapSakit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Sakit</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="transactions">
                        <?php foreach ($allsurat as $a) {
                            if ($a->keterangan == 'Sakit') {
                        ?>
                                <a href="#" class="item">
                                    <div class="detail">
                                        <?php
                                        if ($a->keterangan == 'Sakit') {
                                            $icon   = "S.png";
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
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade action-sheet" id="rekapSID" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data SID</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="transactions">
                        <?php foreach ($allsurat as $a) {
                            if ($a->keterangan == 'SID') {
                        ?>
                                <a href="#" class="item">
                                    <div class="detail">
                                        <?php
                                        if ($a->keterangan == 'SID') {
                                            $icon   = "SID.png";
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
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade action-sheet" id="rekapIzin" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Izin</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="transactions">
                        <?php foreach ($allsurat as $a) {
                            if ($a->keterangan == 'Izin') {
                        ?>
                                <a href="#" class="item">
                                    <div class="detail">
                                        <?php
                                        if ($a->keterangan == 'Izin') {
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
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade action-sheet" id="rekapAlfa" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Alfa</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="transactions">
                        <?php foreach ($allsurat as $a) {
                            if ($a->keterangan == 'Alfa') {
                        ?>
                                <a href="#" class="item">
                                    <div class="detail">
                                        <?php
                                        if ($a->keterangan == 'Alfa') {
                                            $icon   = "A.png";
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
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade action-sheet" id="detailPresensi" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Presensi</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="transactions" id="viewDetailPresensi">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade action-sheet" id="scanMasuk" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Scan Masuk</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="transactions">

                        <?php if ($data['id_kantor'] == 'PST' or $data['id_kantor'] == 'TSM') { ?>

                            <a href="#" class="item AbsenMasuk" data-shift="Non Shift" style="background-color:#0d6efd">
                                <div class="detail">
                                    <img src="<?php echo base_url(); ?>assets/img/icon/Scan.png" alt="img" class="image-block imaged w48">
                                    <div>
                                        <strong>Non Shift</strong>
                                        <p style="color:white">Masuk Jam 08:00</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="item AbsenMasuk" data-shift="Shift 1" style="background-color:#0d6efd">
                                <div class="detail">
                                    <img src="<?php echo base_url(); ?>assets/img/icon/Scan.png" alt="img" class="image-block imaged w48">
                                    <div>
                                        <strong>Shift 1</strong>
                                        <p style="color:white">Masuk Jam 07:00</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="item AbsenMasuk" data-shift="Shift 2" style="background-color:#0d6efd">
                                <div class="detail">
                                    <img src="<?php echo base_url(); ?>assets/img/icon/Scan.png" alt="img" class="image-block imaged w48">
                                    <div>
                                        <strong>Shift 2</strong>
                                        <p style="color:white">Masuk Jam 15:00</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="item AbsenMasuk" data-shift="Shift 3" style="background-color:#0d6efd">
                                <div class="detail">
                                    <img src="<?php echo base_url(); ?>assets/img/icon/Scan.png" alt="img" class="image-block imaged w48">
                                    <div>
                                        <strong>Shift 3</strong>
                                        <p style="color:white">Masuk Jam 23:00</p>
                                    </div>
                                </div>
                            </a>

                        <?php } else { ?>

                            <a href="#" class="item AbsenMasukCabang" data-shift="Non Shift" style="background-color:#0d6efd">
                                <div class="detail">
                                    <img src="<?php echo base_url(); ?>assets/img/icon/Scan.png" alt="img" class="image-block imaged w48">
                                    <div>
                                        <strong>Non Shift</strong>
                                        <p style="color:white">Masuk Jam 08:00</p>
                                    </div>
                                </div>
                            </a>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade action-sheet" id="scanPulang" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Scan Pulang</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="transactions">

                        <?php if ($data['id_kantor'] == 'PST' or $data['id_kantor'] == 'TSM') { ?>
                            <a href="#" class="item AbsenPulang" data-shift="All Shift" style="background-color:#0f8647">
                                <div class="detail">
                                    <img src="<?php echo base_url(); ?>assets/img/icon/Scan.png" alt="img" class="image-block imaged w48">
                                    <div>
                                        <strong>Pulang</strong>
                                        <p style="color:white">Khusus Non Shift, Shift 1 & Shift 2</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="item AbsenPulang" data-shift="Shift 3" style="background-color:#0f8647">
                                <div class="detail">
                                    <img src="<?php echo base_url(); ?>assets/img/icon/Scan.png" alt="img" class="image-block imaged w48">
                                    <div>
                                        <strong>Pulang Shift 3</strong>
                                        <p style="color:white">Khusus Shift 3</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="item AbsenPulang" data-shift="All Shift" style="background-color:#0f8647">
                                <div class="detail">
                                    <img src="<?php echo base_url(); ?>assets/img/icon/Scan.png" alt="img" class="image-block imaged w48">
                                    <div>
                                        <strong>Pulang</strong>
                                        <p style="color:white">Khusus Shift 3 Set-Hari</p>
                                    </div>
                                </div>
                            </a>

                        <?php } else { ?>

                            <a href="#" class="item AbsenPulangCabang" data-shift="All Shift" style="background-color:#0f8647">
                                <div class="detail">
                                    <img src="<?php echo base_url(); ?>assets/img/icon/Scan.png" alt="img" class="image-block imaged w48">
                                    <div>
                                        <strong>Scan Pulang</strong>
                                        <p style="color:white">Khusus Non Shift, Shift 1 & Shift 2</p>
                                    </div>
                                </div>
                            </a>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function getDistanceBetweenPoints(latitude1, longitude1, latitude2, longitude2, unit) {
        let theta = longitude1 - longitude2;
        let distance = 60 * 1.1515 * (180 / Math.PI) * Math.acos(
            Math.sin(latitude1 * (Math.PI / 180)) * Math.sin(latitude2 * (Math.PI / 180)) +
            Math.cos(latitude1 * (Math.PI / 180)) * Math.cos(latitude2 * (Math.PI / 180)) * Math.cos(theta * (Math.PI / 180))
        );
        if (unit == 'miles') {
            return Math.round(distance, 2);
        } else if (unit == 'kilometers') {
            return Math.round(distance * 1.609344, 2);
        } else if (unit == 'meters') {
            return Math.round((distance * 1.609344) * 1000, 2);
        }
    }

    var id_kantor = "<?php echo $data['id_kantor']; ?>"

    if (id_kantor == 'SMR') {

        var latitude = "-7.029536182232125";
        var longitude = "110.53188695327646";
        var jarakPerMeters = 30;

    } else if (id_kantor == 'PWT') {

        var latitude = "-7.407994975658409";
        var longitude = "109.22193834783248";
        var jarakPerMeters = 30;

    } else if (id_kantor == 'BDG') {

        var latitude = "-6.953768054887177";
        var longitude = "107.53436586700703";
        var jarakPerMeters = 55;

    } else if (id_kantor == 'BTN') {

        var latitude = "-6.071677747072659";
        var longitude = "106.15703044018093";
        var jarakPerMeters = 40;

    } else if (id_kantor == 'SKB') {

        var latitude = "-6.948504049510729";
        var longitude = "106.91368460649979";
        var jarakPerMeters = 40;

    } else if (id_kantor == 'SBY') {

        var latitude = "-7.371883216190574";
        var longitude = "112.69533036510262";
        var jarakPerMeters = 30;

    } else if (id_kantor == 'KLT') {

        var latitude = "-7.682561391801011";
        var longitude = "110.63491409130759";
        var jarakPerMeters = 50;

    } else if (id_kantor == 'BGR') {

        var latitude = "-6.5556341230227995";
        var longitude = "106.81052507568654";
        var jarakPerMeters = 40;

    } else if (id_kantor == 'PST') {

        var latitude = "-7.366124483640964";
        var longitude = "108.21447492989039";
        var jarakPerMeters = 80;

    }


    navigator.geolocation.getCurrentPosition(
        function revealPosition(position) {

            var data = position.coords;

            var lat = data.latitude;

            var long = data.longitude;


            var map = L.map('map').setView([latitude, longitude], 18);
            L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                maxZoom: 17,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);

            var marker = L.marker([lat, long]).addTo(map);

            var circle = L.circle([latitude, longitude], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: jarakPerMeters
            }).addTo(map);

        });

    $(document).ready(function() {


        $("#homenav").addClass("active");

        $(".detailPresensi").click(function() {

            var kode_absensi = $(this).attr("data-id");

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>Absensi/detailPresensi',
                data: {
                    kode_absensi: kode_absensi,
                },
                cache: false,
                success: function(respond) {

                    $('#viewDetailPresensi').html(respond);
                    $('#detailPresensi').modal('show');

                }

            });

        });


        $(".AbsenMasuk").click(function() {

            var masuk = "<?php echo $data['masuk']; ?>";
            var shift = $(this).attr("data-shift");
            var id_kantor = "<?php echo $data['id_kantor']; ?>"


            $('#scanMasuk').modal('hide');

            navigator.geolocation.getCurrentPosition(
                function revealPosition(position) {


                    var data = position.coords;

                    var lat = data.latitude;

                    var long = data.longitude;

                    var jarakPusat = getDistanceBetweenPoints(latitude, longitude, lat, long, "meters");

                    if (jarakPusat >= jarakPerMeters) {

                        Swal.fire(
                            'Opps..!!',
                            'Belum Berada di id_kantor, Jarak > ' + jarakPusat,
                            'warning'
                        )

                    } else if (masuk != '') {

                        Swal.fire(
                            'Opps..!!',
                            'Sudah Scan Masuk',
                            'warning'
                        )

                    } else {

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "Scan Masuk",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Scan Now'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url(); ?>Absensi/InsertAbsenMasuk',
                                    data: {
                                        latitude: lat,
                                        longitude: long,
                                        shift: shift,
                                    },
                                    cache: false,
                                    success: function() {

                                        Swal.fire(
                                            'Berhasil',
                                            'Scan Masuk Berhasil',
                                            'success'
                                        )
                                        location.reload();

                                    }

                                });
                            }
                        })


                    }

                    // $("#lokasi").val(Lokasi);
                    // $("#latitude").val(lat);
                    // $("#longitude").val(long);

                }
            );

        });

        $(".AbsenPulang").click(function() {

            var pulang = "<?php echo $data['pulang']; ?>";
            var kode_absensi = "<?php echo $data['kode_absensi']; ?>";
            var shift = $(this).attr("data-shift");

            $('#scanPulang').modal('hide');

            navigator.geolocation.getCurrentPosition(
                function revealPosition(position) {

                    var data = position.coords;

                    var lat = data.latitude;

                    var long = data.longitude;

                    var jarakPusat = getDistanceBetweenPoints(latitude, longitude, lat, long, "meters");

                    if (jarakPusat >= jarakPerMeters) {

                        Swal.fire(
                            'Opps..!!',
                            'Belum Berada di id_kantor > Jarak ' + jarakPusat,
                            'warning'
                        )

                    } else if (pulang != '') {

                        Swal.fire(
                            'Opps..!!',
                            'Sudah Scan Pulang',
                            'warning'
                        )

                    } else {

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "Scan Pulang",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Scan Now'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url(); ?>Absensi/UpdateAbsenPulang',
                                    data: {
                                        latitude: lat,
                                        longitude: long,
                                        shift: shift,
                                        kode_absensi: kode_absensi,
                                    },
                                    cache: false,
                                    success: function() {

                                        Swal.fire(
                                            'Berhasil',
                                            'Scan Pulang Berhasil',
                                            'success'
                                        )
                                        location.reload();

                                    }

                                });
                            }
                        })



                    }

                    // $("#lokasi").val(Lokasi);
                    // $("#latitude").val(lat);
                    // $("#longitude").val(long);

                }
            );


        });

        $(".AbsenMasukCabang").click(function() {

            var masuk = "<?php echo $data['masuk']; ?>";
            var shift = $(this).attr("data-shift");
            var id_kantor = "<?php echo $data['id_kantor']; ?>"

            $('#scanMasuk').modal('hide');

            navigator.geolocation.getCurrentPosition(
                function revealPosition(position) {

                    var data = position.coords;

                    var lat = data.latitude;

                    var long = data.longitude;

                    var jarakPusat = getDistanceBetweenPoints(latitude, longitude, lat, long, "meters");
                    if (jarakPusat >= jarakPerMeters) {

                        Swal.fire(
                            'Opps..!!',
                            'Belum Berada di id_kantor > Jarak ' + jarakPusat,
                            'warning'
                        )

                    } else if (masuk != '') {

                        Swal.fire(
                            'Opps..!!',
                            'Sudah Scan Masuk',
                            'warning'
                        )

                    } else {

                        $.ajax({
                            type: 'POST',
                            url: '<?php echo base_url(); ?>Absensi/InsertAbsenMasuk',
                            data: {
                                latitude: lat,
                                longitude: long,
                                shift: shift,
                            },
                            cache: false,
                            success: function() {

                                Swal.fire(
                                    'Berhasil',
                                    'Scan Masuk Berhasil',
                                    'success'
                                )
                                location.reload();

                            }

                        });

                    }

                    // $("#lokasi").val(Lokasi);
                    // $("#latitude").val(lat);
                    // $("#longitude").val(long);

                }
            );

        });


        $(".AbsenPulangCabang").click(function() {

            var pulang = "<?php echo $data['pulang']; ?>";
            var kode_absensi = "<?php echo $data['kode_absensi']; ?>";
            var id_kantor = "<?php echo $data['id_kantor']; ?>"
            var shift = $(this).attr("data-shift");

            $('#scanPulang').modal('hide');

            navigator.geolocation.getCurrentPosition(
                function revealPosition(position) {

                    var data = position.coords;

                    var lat = data.latitude;

                    var long = data.longitude;

                    var jarakPusat = getDistanceBetweenPoints(latitude, longitude, lat, long, "meters");

                    if (jarakPusat >= jarakPerMeters) {

                        Swal.fire(
                            'Opps..!!',
                            'Belum Berada di id_kantor > ' + jarakPusat,
                            'warning'
                        )

                    } else if (pulang != '') {

                        Swal.fire(
                            'Opps..!!',
                            'Sudah Scan Pulang',
                            'warning'
                        )

                    } else {

                        $.ajax({
                            type: 'POST',
                            url: '<?php echo base_url(); ?>Absensi/UpdateAbsenPulang',
                            data: {
                                latitude: lat,
                                longitude: long,
                                shift: shift,
                                kode_absensi: kode_absensi,
                            },
                            cache: false,
                            success: function() {

                                Swal.fire(
                                    'Berhasil',
                                    'Scan Pulang Berhasil',
                                    'success'
                                )
                                location.reload();

                            }

                        });

                    }

                    // $("#lokasi").val(Lokasi);
                    // $("#latitude").val(lat);
                    // $("#longitude").val(long);

                }
            );


        });


    });
</script>