<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <h3 class="">
            Pembayaran SPP
            <a href="<?php echo site_url('admin/spp/add'); ?>" ><span class="glyphicon glyphicon-plus-sign"></span></a>
        </h3><br>
        <span class="pull-right">
            <a class="btn btn-sm btn-default" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" ><span class="glyphicon glyphicon-align-justify"></span></a>
        </span>
    </h3>       
</h3>
<div>
    <?php echo form_open(current_url(), array('method' => 'get')) ?>
    <div class="row">                
        <div class="col-md-3">                 
            <input autofocus type="text" name="n" id="field" placeholder="NISN" class="form-control">            
        </div>                
        <input type="submit" class="btn btn-success" value="Cari">
    </div>
</div>
<?php echo form_close() ?>
</div>
<?php echo validation_errors() ?>
<br>

<div class="table-responsive">
    <table class="table table-striped">
        <thead class="gradient">
            <tr>
                <th>No</th>
                <th>No. Pembayaran</th>
                <th>Nama Siswa</th>
                <th>NISN</th>
                <th>Tanggal Bayar</th>
                <th>Bulan SPP</th>
                <th>Biaya SPP</th>
                <th>Total Biaya</th>
                <th>Bendahara</th>
                <th>Aksi</th>

            </tr>
        </thead>
        <?php				
        $i =1;
        if (!empty($spp)) {
            foreach ($spp as $row) {
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td ><?php echo $row['kode_bayar']; ?></td>
                        <?php
                            $siswa = $this->Siswa_model->get(array('kode_siswa' => $row['kode_siswa']));
                            
                        ?>
                        <td ><?php echo $siswa['siswa_nama']; ?></td>
                        <td ><?php echo $siswa['siswa_nisn']; ?></td>
                        <td ><?php echo $row['tgl_byr']; ?></td>
                        <?php
                            $detail = $this->Spp_model->getdetail(array('kode_bayar' => $row['kode_bayar']));
                            
                        ?>
                        <td ><?php foreach ($detail as $key) {
                                echo $key['bulan'].'<br>';
                            }
                             ?></td>
                        <td >Rp. <?php echo $row['biaya_spp']; ?></td>
                        <td >Rp. <?php echo $row['total_biaya']; ?></td>
                        <td ><?php echo $row['bendahara']; ?></td>

                        
                        
                        <td>
                            <a class="btn btn-warning btn-xs" href="<?php echo site_url('admin/spp/detail/' . $row['kode_bayar']); ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                            <a class="btn btn-success btn-xs" href="<?php echo site_url('admin/spp/add/' . $row['kode_bayar']); ?>" ><span class="glyphicon glyphicon-edit"></span></a>
                            <a class="btn btn-danger btn-xs" href="<?php echo site_url('admin/spp/delete/' . $row['kode_bayar']); ?>" ><span class="glyphicon glyphicon-trash"></span></a>

                            
                            </td>
                        </tr>
                    </tbody>
                    <?php
                    $i++;
                } 
            } else {
                ?>
                <tbody>
                    <tr id="row">
                        <td colspan="5" align="center">Data Kosong</td>
                    </tr>
                </tbody>
                <?php
            }
            ?>   
        </table>
    </div>
    <div >
        <?php echo $this->pagination->create_links(); ?>
    </div>
</div>
</div>

<script>
    $(function() {

        var siswa_list = [
        <?php foreach ($spps as $row): ?>
        {
                       
            "label": "<?php echo $row['siswa_nama'] ?>",
            "label_nik": "<?php echo $row['siswa_nisn'] ?>"

        },
    <?php endforeach; ?>
    ];
    function custom_source(request, response) {
        var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
        response($.grep(siswa_list, function(value) {
            return matcher.test(value.label)
            || matcher.test(value.label_nik);
        }));
    }

    $("#field").autocomplete({
        source: custom_source,
        minLength: 1,
        select: function(event, ui) {
                // feed hidden id field                
                $("#field_id").val(ui.item.label_nik);  
                $("#field_name").val(ui.item.value);                

                // update number of returned rows
            },
            open: function(event, ui) {
                // update number of returned rows
                var len = $('.ui-autocomplete > li').length;
            },
            close: function(event, ui) {
                // update number of returned rows
            },
            // mustMatch implementation
            change: function(event, ui) {
                if (ui.item === null) {
                    $(this).val('');
                    $('#field_id').val('');
                }
            }
        });

        // mustMatch (no value) implementation
        $("#field").focusout(function() {
            if ($("#field").val() === '') {
                $('#field_id').val('');
            }
        });
    });
</script>