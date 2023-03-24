<div class="section mt-3 text-center">
    <div class="avatar-section">
        <a href="#" data-bs-toggle="modal" data-bs-target="#updateFoto">
            <?php if ($data['foto'] != '') { ?>
                <img src="<?php echo base_url(); ?>assets/img/karyawan/<?php echo $data['foto']; ?>" alt="avatar" class="imaged w100 rounded">
            <?php } else { ?>
                <img src="<?php echo base_url(); ?>assets/img/pria.png" alt="avatar" class="imaged w100 rounded">
            <?php } ?>
            <span class="button">
                <ion-icon name="camera-outline"></ion-icon>
            </span>
        </a>
    </div>
</div>

<div class="listview-title mt-1">Profile</div>
<ul class="listview image-listview text inset">
    <li>
        <a href="#" class="item" data-bs-toggle="modal" data-bs-target="#lihatProfile">
            <div class="in">
                <div>Data Karyawan</div>
                <span class="text-primary">Lihat</span>
            </div>
        </a>
    </li>
</ul>

<div class="listview-title mt-1">Pengaturan Profile</div>
<ul class="listview image-listview text inset">
    <li>
        <a href="#" class="item">
            <div class="in">
                <div>Profile</div>
                <span class="text-primary">Edit</span>
            </div>
        </a>
    </li>
    <li>
        <a href="#" class="item">
            <div class="in">
                <div>Update E-mail</div>
            </div>
        </a>
    </li>
</ul>

<div class="listview-title mt-1">Kemanan</div>
<ul class="listview image-listview text mb-2 inset">
    <li>
        <a href="#" class="item">
            <div class="in">
                <div>Cek Lokasi</div>
            </div>
        </a>
    </li>
    <li>
        <a href="#" class="item">
            <div class="in">
                <div>Update Password</div>
            </div>
        </a>
    </li>
    <li>
        <a href="<?php echo base_url(); ?>auth/logout" class="item">
            <div class="in">
                <div>Log Out</div>
            </div>
        </a>
    </li>
</ul>

<div class="modal fade action-sheet" id="updateFoto" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Foto</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="transactions">
                        <div class="action-sheet-content">
                            <form action="<?php echo base_url(); ?>Absensi/updateFoto" method="post" enctype="multipart/form-data">
                                <input type="file" name="foto" class="form-control" placeholder="Foto">
                                <br>
                                <div class="form-group basic">
                                    <button href="#" class="btn btn-primary btn-block btn-md">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade action-sheet" id="lihatProfile" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Karyawan</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="transactions">
                        <ul class="listview image-listview">
                            <li>
                                <a href="#" class="item">
                                    <div class="in">
                                        <div><?php echo $kry['nama_karyawan']; ?></div>
                                        <span class="text-muted">Nama Lengkap</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="item">
                                    <div class="in">
                                        <div><?php echo DateToIndo($kry['tgl_masuk']); ?></div>
                                        <span class="text-muted">Tanggal Masuk</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="item">
                                    <div class="in">
                                        <div><?php echo $kry['tempat_lahir']; ?></div>
                                        <span class="text-muted">Tempat Lahir</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="item">
                                    <div class="in">
                                        <div><?php echo DateToIndo($kry['tgl_lahir']); ?></div>
                                        <span class="text-muted">Tgl Lahir</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="item">
                                    <div class="in">
                                        <div><?php echo $kry['alamat']; ?></div>
                                        <span class="text-muted">Alamat</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="item">
                                    <div class="in">
                                        <div><?php echo $kry['no_hp']; ?></div>
                                        <span class="text-muted">No HP</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $("#profile").addClass("active");

    });
</script>