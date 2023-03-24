<div class="action-sheet-content">

    <div class="form-group basic">
        <div class="input-wrapper">
            <label class="label" for="currency2">Tanggal</label>
            <input type="date" value="<?php echo $suratabsen['tanggal'];?>" class="form-control" id="tanggal" placeholder="Tanggal">
            <input type="hidden" value="<?php echo $suratabsen['kode_surat'];?>" class="form-control" id="kode_surat" placeholder="Kode Surat">
        </div>
    </div>

    <div class="form-group basic">
        <div class="input-wrapper">
            <label class="label" for="currency1">Jenis Surat</label>
            <select class="form-control custom-select" id="jenis_surat">
                <option <?php if( $suratabsen['jenis_izin'] == "Cuti Tahunan"){ echo "selected"; } ?> value="Cuti Tahunan">Cuti Tahunan</option>
                <option <?php if( $suratabsen['jenis_izin'] == "Cuti Melahirkan/Keguguran"){ echo "selected"; } ?> value="Cuti Melahirkan/Keguguran">Cuti Melahirkan/Keguguran</option>
                <option <?php if( $suratabsen['jenis_izin'] == "Cuti Khusus Sesuai (PP)"){ echo "selected"; } ?> value="Cuti Khusus Sesuai (PP)">Cuti Khusus Sesuai (PP)</option>
                <option <?php if( $suratabsen['jenis_izin'] == "Izin Tidak Masuk Kerja"){ echo "selected"; } ?> value="Izin Tidak Masuk Kerja">Izin Tidak Masuk Kerja</option>
                <option <?php if( $suratabsen['jenis_izin'] == "Sakit Tanpa SID"){ echo "selected"; } ?> value="Sakit Tanpa SID">Sakit Tanpa SID</option>
                <option <?php if( $suratabsen['jenis_izin'] == "Sakit Dengan SID"){ echo "selected"; } ?> value="Sakit Dengan SID">Sakit Dengan SID</option>
            </select>
        </div>
    </div>

    <div class="form-group basic">
        <div class="input-wrapper">
            <label class="label" for="currency1">Isi Surat</label>
            <textarea type="text" class="form-control" id="deskripsi" rows="5"><?php echo $suratabsen['isi'];?></textarea>
        </div>
    </div>
    
    <div class="row">
        <div class="col-6">
            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="currency2">Head Dept</label>
                    <input style="color:<?php if($suratabsen['head_dept'] != '' ){ echo '#1dcc70'; }else{ echo '#cc1d1d'; } ?>" type="text" readonly value="<?php if($suratabsen['head_dept'] != '' ){ echo $suratabsen['head_dept']; }else{ echo 'Pending'; } ?>" class="form-control" id="head_dept" placeholder="Head Dept">
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="currency2">HRD</label>
                    <input style="color:<?php if($suratabsen['hrd'] != '' ){ echo '#1dcc70'; }else{ echo '#cc1d1d'; } ?>" type="text" readonly value="<?php if($suratabsen['hrd'] != '' ){ echo $suratabsen['hrd']; }else{ echo 'Pending'; } ?>" class="form-control" id="hrd" placeholder="HRD">
                </div>
            </div>
        </div>
    </div>
        
    <div class="row">
        <div class="col-6">
            <div class="form-group basic">
                <a href="#" class="btn btn-primary btn-block btn-lg" id="updateSurat">Update</a>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group basic">
                <a href="#" class="btn btn-danger btn-block btn-lg" id="hapusSurat">Hapus</a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function() {

        
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
        
        $("#updateSurat").click(function(e) {
            e.preventDefault();
            
            var kode_surat = $("#kode_surat").val();
            var hrd = $("#hrd").val();
            var head_dept = $("#head_dept").val();
            var dari = $("#tanggal").val();
            var sampai = $("#tanggal").val();
            var deskripsi = $("#deskripsi").val();
            var jenis_surat = $("#jenis_surat").val();
            
            if(head_dept == 'Diterima'){
                $('#TombolBatal').modal('hide');
                Swal.fire(
                  'Tidak Bisa Diedit',
                  'Surat Absen sudah diterima Head Dept/HRD',
                  'warning'
                )
            }else if(hrd == 'Diterima'){
                $('#TombolBatal').modal('hide');
                Swal.fire(
                  'Tidak Bisa Diedit',
                  'Surat Absen sudah diterima Head Dept/HRD',
                  'warning'
                )
            }else{
                
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>Absensi/simpanSurat',
                    data: 
                    {
                        kode_surat : kode_surat,
                        dari : dari,
                        sampai : sampai,
                        deskripsi : deskripsi,
                        jenis_surat : jenis_surat,
                    },
                    cache: false,
                    success: function(respond) {
                                
                        Swal.fire(
                          'Berhasil',
                          'Data berhasil di simpan',
                          'success'
                        )
                        $('#TombolBatal').modal('hide');
                        viewSuratAbsen();
            
                    }
            
                });
                
            }
        });
        
        $("#hapusSurat").click(function(e) {
            e.preventDefault();
            
            var kode_surat = $("#kode_surat").val();
            var head_dept = $("#head_dept").val();
            var hrd = $("#head_dept").val();
            
            if(head_dept == 'Diterima'){
                $('#TombolBatal').modal('hide');
                Swal.fire(
                  'Tidak Bisa Dihapus',
                  'Surat Absen sudah diterima Head Dept/HRD',
                  'warning'
                )
            }else if(hrd == 'Diterima'){
                
                $('#TombolBatal').modal('hide');
                Swal.fire(
                  'Tidak Bisa Dihapus',
                  'Surat Absen sudah diterima Head Dept/HRD',
                  'warning'
                )
            }else{
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>Absensi/hapusSurat',
                    data: 
                    {
                        kode_surat : kode_surat,
                    },
                    cache: false,
                    success: function(respond) {
                         
                        Swal.fire(
                          'Berhasil',
                          'Data berhasil di hapus',
                          'success'
                        )
                        $('#TombolBatal').modal('hide');
                        viewSuratAbsen();
            
                    }
            
                });
            
            }
        });
        
    });
    
</script>