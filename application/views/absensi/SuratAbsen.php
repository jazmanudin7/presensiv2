<style>
   .btnadd{
        width:60px;
        height:60px;
        border-radius:100%;
        background:#0f8647;
        border:none;
        outline:none;
        position: fixed;
        color:#FFF;
        font-size:36px;
        box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
        transition:.3s;  
        bottom: 71px;
        right: 20px;
        z-index: 999;
        cursor: pointer;
      -webkit-tap-highlight-color: rgba(0,0,0,0);
    }

</style>

<div class="section pt-1">
    <div class="row">
        <div class="col-6">
            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="currency2">Tahun</label>
                    <select class="form-control custom-select" id="tahun">
                        <option value="">PILIH TAHUN</option>
                        <option <?php if(Date('Y') == '2022'){ echo "selected"; } ?> value="2022">2022</option>
                        <option <?php if(Date('Y') == '2023'){ echo "selected"; } ?> value="2023">2023</option>
                        <option <?php if(Date('Y') == '2024'){ echo "selected"; } ?> value="2024">2024</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="currency1">Bulan</label>
                     <select class="form-control custom-select" id="bulan">
                        <option value="">PILIH BULAN</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
            </div>
        </div
    </div>
    <div class="transactions" id="viewSuratAbsen">
        
    </div>
</div>

<button href="#" class="btnadd" data-bs-toggle="modal" data-bs-target="#InputSuratAbsen">+</button>

<div class="modal fade action-sheet" id="InputSuratAbsen" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Surat Keterangan Absen</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="currency1">Dari</label>
                                    <input type="date" class="form-control" id="dari" required placeholder="Dari">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="currency2">Sampai</label>
                                    <input type="date" class="form-control" id="sampai" required placeholder="Sampai">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="currency1">Jenis Surat</label>
                            <select class="form-control custom-select" id="jenis_surat" required>
                                <option value="Cuti Tahunan">Cuti Tahunan</option>
                                <option value="Cuti Melahirkan/Keguguran">Cuti Melahirkan/Keguguran</option>
                                <option value="Cuti Khusus Sesuai (PP)">Cuti Khusus Sesuai (PP)</option>
                                <option value="Izin Tidak Masuk Kerja">Izin Tidak Masuk Kerja</option>
                                <option value="Sakit Tanpa SID">Sakit Tanpa SID</option>
                                <option value="Sakit Dengan SID">Sakit Dengan SID</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="currency1">Isi Surat</label>
                            <textarea type="text" class="form-control" id="deskripsi" rows="5" required></textarea>
                        </div>
                    </div>

                    <div class="form-group basic">
                        <a href="#" class="btn btn-primary btn-block btn-lg" id="simpanSurat">Simpan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function() {

        viewSuratAbsen();
        
        function viewSuratAbsen(){
        
            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();
            
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>Absensi/viewSuratAbsen',
                data: 
                {
                    tahun : tahun,
                    bulan : bulan,
                },
                cache: false,
                success: function(html) {
                    
                    
                    $("#viewSuratAbsen").html(html);   
        
                }
        
            });
        }
        
        
        $("#bulan,#tahun").change(function() {
            
            viewSuratAbsen();
        });
        
        
        $("#simpanSurat").click(function() {
            
            var dari = $("#dari").val();
            var sampai = $("#sampai").val();
            var jenis_surat = $("#jenis_surat").val();
            var deskripsi = $("#deskripsi").val();
            
            if(dari == '' & sampai == ''){
                
                Swal.fire(
                  'Opps..!!',
                  'Tanggal belum diisi',
                  'warning'
                )
                
            }else if(jenis_surat == ''){
            
                Swal.fire(
                  'Opps..!!',
                  'Jenis Surat belum dipilih',
                  'warning'
                )
                
            }else{
                
                $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>Absensi/simpanSurat',
                data: 
                {
                    dari : dari,
                    sampai : sampai,
                    jenis_surat : jenis_surat,
                    deskripsi : deskripsi,
                },
                cache: false,
                success: function() {
                    
                    window.location.href = "https://mobile.pedasalami.com/Absensi/SuratAbsen";
        
                }
                });
            }
    
            
        });
        
    });
    
</script>