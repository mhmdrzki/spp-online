<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <h3 class="">
            Daftar Siswa
            <a href="<?php echo site_url('admin/siswa/add'); ?>" ><span class="glyphicon glyphicon-plus-sign"></span></a>
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
            <input autofocus type="text" name="n" id="field" placeholder="Nama Lengkap" class="form-control">            
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
                <th>NISN</th>
                <th>Nama Lengkap</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Masuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php	
        $no=1;			
        if (!empty($siswa)) {
            foreach ($siswa as $row) {
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $no;?></td>
                        <td ><?php echo $row['siswa_nisn']; ?></td>
                        <td ><?php echo $row['siswa_nama']; ?></td>
                        <td ><?php echo $row['siswa_tmpt_lhr'].", ".pretty_date($row['siswa_tgl_lhr'], 'd F Y',false); ?></td>
                        <td ><?php echo $row['siswa_jk']; ?></td>
                        <td ><?php echo pretty_date($row['siswa_tgl_masuk'], 'd F Y',false); ?></td>
                        <td>
                            <a class="btn btn-warning btn-xs" href="<?php echo site_url('admin/siswa/detail/' . $row['kode_siswa']); ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                            <a class="btn btn-success btn-xs" href="<?php echo site_url('admin/siswa/add/' . $row['kode_siswa']); ?>" ><span class="glyphicon glyphicon-edit"></span></a>
                            <a class="btn btn-danger btn-xs" href="<?php echo site_url('admin/siswa/delete/' . $row['kode_siswa']); ?>" ><span class="glyphicon glyphicon-trash"></span></a>


                            
                            
                            </td>
                        </tr>
                    </tbody>
                    <?php
                    $no++;
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
        <?php foreach ($siswas as $row): ?>
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