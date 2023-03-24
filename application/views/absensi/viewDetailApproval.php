<div class="action-sheet-content">

    <div class="form-group basic">
        <div class="input-wrapper">
            <label class="label" for="currency2">Tanggal</label>
            <input type="date" readonly value="<?php echo $suratabsen['tanggal'];?>" class="form-control" id="tanggal" placeholder="Tanggal">
            <input type="hidden" readonly value="<?php echo $suratabsen['kode_surat'];?>" class="form-control" id="kode_surat" placeholder="Kode Surat">
        </div>
    </div>

    <div class="form-group basic">
        <div class="input-wrapper">
            <label class="label" for="currency1">Jenis Surat</label>
            <input type="text" readonly value="<?php echo $suratabsen['jenis_izin'];?>" class="form-control" id="jenis_surat" placeholder="Jenis Izin">
        </div>
    </div>

    <div class="form-group basic">
        <div class="input-wrapper">
            <label class="label" for="currency1">Isi Surat</label>
            <textarea readonly type="text" class="form-control" id="deskripsi" rows="5"><?php echo $suratabsen['isi'];?></textarea>
        </div>
    </div>
    
    <div class="row">
        <div class="col-6">
            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="currency2">Head Dept</label>
                    <input readonly style="color:<?php if($suratabsen['head_dept'] != '' ){ echo '#1dcc70'; }else{ echo '#cc1d1d'; } ?>" type="text" readonly value="<?php if($suratabsen['head_dept'] != '' ){ echo $suratabsen['head_dept']; }else{ echo 'Pending'; } ?>" class="form-control" id="head_dept" placeholder="Head Dept">
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="currency2">HRD</label>
                    <input readonly style="color:<?php if($suratabsen['hrd'] != '' ){ echo '#1dcc70'; }else{ echo '#cc1d1d'; } ?>" type="text" readonly value="<?php if($suratabsen['hrd'] != '' ){ echo $suratabsen['hrd']; }else{ echo 'Pending'; } ?>" class="form-control" id="hrd" placeholder="HRD">
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-6">
            <div class="form-group basic">
                <a href="#" class="btn btn-primary btn-block btn-lg" id="TerimaSurat">Terima</a>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group basic">
                <a href="#" class="btn btn-danger btn-block btn-lg" id="TolakSurat">Tolak</a>
            </div>
        </div>
    </div>
    
</div>


<script type="text/javascript">

    $(document).ready(function() {

        
        $("#TerimaSurat").click(function(e) {
            e.preventDefault();
          
            var head_dept = $("#head_dept").val();
            var hrd = $("#hrd").val();
            var kode_surat = $("#kode_surat").val();
            
            if(head_dept == 'Pending'){
                var jenis_approval = 'Head Dept'; 
            }else if(hrd == 'Pending'){
                var jenis_approval = 'HRD';
            }
            
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>absensi/approval',
                data: 
                {
                    kode_surat : kode_surat,
                    jenis_approval : jenis_approval,
                    status : "Diterima",
                },
                cache: false,
                success: function(respond) {
                            
                    Swal.fire(
                      'Berhasil',
                      'Data berhasil di Approve',
                      'success'
                    )
                    $('#TombolBatal').modal('hide');
        
                }
        
            });
            
        });
        
        
        
        $("#TolakSurat").click(function(e) {
            e.preventDefault();
          
            var head_dept = $("#head_dept").val();
            var hrd = $("#hrd").val();
            var kode_surat = $("#kode_surat").val();
            
            if(head_dept == 'Pending'){
                var jenis_approval = 'Head Dept'; 
            }else if(hrd == 'Pending'){
                var jenis_approval = 'HRD';
            }
            
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>absensi/approval',
                data: 
                {
                    kode_surat : kode_surat,
                    jenis_approval : jenis_approval,
                    status : "Ditolak",
                },
                cache: false,
                success: function(respond) {
                            
                    Swal.fire(
                      'Berhasil',
                      'Data berhasil di Approve',
                      'success'
                    )
                    $('#TombolBatal').modal('hide');
        
                }
        
            });
            
        });
        
    });
    
</script>