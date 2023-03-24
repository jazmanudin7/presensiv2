<?php foreach($surat as $s){ ?>
    <a href="#" data-id="<?php echo $s->kode_surat;?>" class="item TombolBatal">
        <div class="detail">
            <?php
            if($s->keterangan == 'Cuti'){
                $icon   = "C.png"; 
            }else if($s->keterangan == 'Sakit'){
                $icon   = "S.png"; 
            }else if($s->keterangan == 'SID'){
                $icon   = "SID.png"; 
            }else if($s->keterangan == 'Izin' OR $s->keterangan == 'Cuti Khusus'){
                $icon   = "I.png"; 
            }else{
                $icon   = "A.png"; 
            }
            ?>
            <img src="<?php echo base_url();?>assets/img/icon/<?php echo $icon;?>" alt="img" class="image-block imaged w48">
            <div>
                <strong><?php echo $s->nama_karyawan;?></strong>
                <p><?php echo $s->keterangan;?></p>
            </div>
        </div>
        <div class="right">
            <div class="price"><?php echo $s->tanggal;?></div>
            <p class="<?php if($s->hrd != 'Diterima'){ echo "text-danger"; }else{ echo "text-success"; } ?>"><?php if($s->hrd != 'Diterima'){ echo "Pending"; }else{ echo "Diterima"; } ?></p>
        </div>
    </a>
<?php } ?>


<div class="modal fade action-sheet" id="TombolBatal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Surat Absen</h5>
            </div>
            <div class="modal-body" id="viewDetailSuratAbsen">
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {

        $("#suratabsen").addClass("active");
        $(".TombolBatal").click(function() {
            
            var kode_surat = $(this).attr("data-id");
            
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>Absensi/viewDetailSuratAbsen',
                data: 
                {
                    kode_surat : kode_surat,
                },
                cache: false,
                success: function(respond) {
                      
                    $('#viewDetailSuratAbsen').html(respond);
                    $('#TombolBatal').modal('show');
        
                }
        
            });
            
        });
    });
    
</script>