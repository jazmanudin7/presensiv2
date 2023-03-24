<div class="section pt-1">
    <div class="row">
        <div class="col-6">
            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="currency2">Tahun</label>
                    <select class="form-control custom-select" id="tahun">
                        <option <?php if (Date('Y') == '2022') {
                                    echo "selected";
                                } ?> value="2022">2022</option>
                        <option <?php if (Date('Y') == '2023') {
                                    echo "selected";
                                } ?> value="2023">2023</option>
                        <option <?php if (Date('Y') == '2024') {
                                    echo "selected";
                                } ?> value="2024">2024</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="currency1">Bulan</label>
                    <select class="form-control custom-select" id="bulan">
                        <option <?php if (Date('m') == '01') {
                                    echo "selected";
                                } ?> value="01">Januari</option>
                        <option <?php if (Date('m') == '02') {
                                    echo "selected";
                                } ?> value="02">Februari</option>
                        <option <?php if (Date('m') == '03') {
                                    echo "selected";
                                } ?> value="03">Maret</option>
                        <option <?php if (Date('m') == '04') {
                                    echo "selected";
                                } ?> value="04">April</option>
                        <option <?php if (Date('m') == '05') {
                                    echo "selected";
                                } ?> value="05">Mei</option>
                        <option <?php if (Date('m') == '06') {
                                    echo "selected";
                                } ?> value="06">Juni</option>
                        <option <?php if (Date('m') == '07') {
                                    echo "selected";
                                } ?> value="07">Juli</option>
                        <option <?php if (Date('m') == '08') {
                                    echo "selected";
                                } ?> value="08">Agustus</option>
                        <option <?php if (Date('m') == '09') {
                                    echo "selected";
                                } ?> value="09">September</option>
                        <option <?php if (Date('m') == '10') {
                                    echo "selected";
                                } ?> value="10">Oktober</option>
                        <option <?php if (Date('m') == '11') {
                                    echo "selected";
                                } ?> value="11">November</option>
                        <option <?php if (Date('m') == '12') {
                                    echo "selected";
                                } ?> value="12">Desember</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="transactions" id="viewAbsensi">

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $("#kehadiran").addClass("active");
        viewDetailAbsensi();

        function viewDetailAbsensi() {

            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>Absensi/viewDetailAbsensi',
                data: {
                    tahun: tahun,
                    bulan: bulan,
                },
                cache: false,
                success: function(html) {


                    $("#viewAbsensi").html(html);

                }

            });
        }

        $("#bulan,#tahun").change(function() {

            viewDetailAbsensi();
        });

    });
</script>