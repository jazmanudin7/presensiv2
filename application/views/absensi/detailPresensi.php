<div class="action-sheet-content">

    <div class="form-group basic">
        <div class="input-wrapper">
            <label class="label" for="currency2">Tanggal</label>
            <input type="text" readonly value="<?php echo DateToIndo($data['tanggal']);?>" class="form-control" id="tanggal" placeholder="Tanggal">
            <input type="hidden" value="<?php echo $data['kode_absensi'];?>" class="form-control" id="kode_absensi" placeholder="Kode Absensi">
        </div>
    </div>
    
    <div class="row">
        <div class="col-6">
            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="currency2">Masuk</label>
                    <input type="text" readonly value="<?php if($data['masuk'] != '' ){ echo $data['masuk']; }else{ echo 'Belum Masuk'; } ?>" class="form-control" id="masuk" placeholder="Head Dept">
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="currency2">Pulang</label>
                    <input type="text" readonly value="<?php if($data['pulang'] != '' ){ echo $data['pulang']; }else{ echo 'Belum Pulang'; } ?>" class="form-control" id="pulang" placeholder="HRD">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group basic">
        <div class="input-wrapper">
            <label class="label" for="currency1">Jenis Surat</label>
            <select class="form-control custom-select" id="shift">
                <option <?php if( $data['shift'] == "Non Shift"){ echo "selected"; } ?> value="Non Shift">Non Shift</option>
                <option <?php if( $data['shift'] == "Shift 1"){ echo "selected"; } ?> value="Shift 1">Shift 1</option>
                <option <?php if( $data['shift'] == "Shift 2"){ echo "selected"; } ?> value="Shift 2">Shift 2</option>
                <option <?php if( $data['shift'] == "Shift 3"){ echo "selected"; } ?> value="Shift 3">Shift 3</option>
            </select>
        </div>
    </div>
    
    
    <div class="form-group basic">
        <a href="#" class="btn btn-primary btn-block btn-lg" id="updateShift">Update</a>
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function() {

        
        $("#updateShift").click(function(e) {
            e.preventDefault();
            
            var kode_absensi = $("#kode_absensi").val();
            var shift = $("#shift").val();
           
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>Absensi/updateShift',
                data: 
                {
                    kode_absensi : kode_absensi,
                    shift : shift,
                },
                cache: false,
                success: function(respond) {
      
                    Swal.fire(
                      'Berhasil',
                      'Shift sudah di update',
                      'success'
                    )
                    window.location.href = "https://mobile.pedasalami.com";
                    $('#detailPresensi').modal('hide');
        
                }
        
            });
        });
        
        
    });
    
</script>