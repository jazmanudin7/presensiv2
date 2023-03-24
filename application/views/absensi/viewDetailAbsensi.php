<?php foreach($absensi as $a){ 
?>
    <a href="#" class="item detailPresensi" data-id="<?php echo $a->kode_absensi;?>"  style="background-color:<?php if( $a->pulang == ''){ echo "#ea9797"; } ?>">
        <div class="detail">
            <img src="<?php echo base_url();?>assets/img/icon/H.png" alt="img" class="image-block imaged w48">
            <div>
                <strong><?php echo DateToIndo($a->tanggal);?></strong>
                <p><?php if($a->masuk != ''){ echo $a->masuk; }else{ echo "Belum Scan Masuk"; } ?> - <?php if($a->pulang != ''){ echo $a->pulang; }else{ echo "Belum Pulang"; } ?></p>
            </div>
        </div>
        <div class="right">
            <div class="price"><?php echo $a->shift;?></div>
            <p style="color:<?php if(substr($a->terlambat,0,1) != '-'){ echo "red"; } ?>"><?php if(substr($a->terlambat,0,1) != '-'){ echo substr($a->terlambat,0,8); } ?></p>
        </div>
    </a>
<?php } ?>
<br>


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

<script type="text/javascript">

    $(document).ready(function() {
        
            
        $(".detailPresensi").click(function(e) {
            e.preventDefault();
            var kode_absensi = $(this).attr("data-id");
            
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>Absensi/detailPresensi',
                data: 
                {
                    kode_absensi : kode_absensi,
                },
                cache: false,
                success: function(respond) {
                      
                    $('#viewDetailPresensi').html(respond);
                    $('#detailPresensi').modal('show');
        
                }
        
            });
            
        });
        
    });
    
</script>