<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <h3 class="">
            Daftar Tunggakan SPP Siswa
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
            <input autofocus type="text" name="n" id="field" placeholder="Nama" class="form-control">            
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
                <th>Nama Siswa</th>
                <th>NISN</th>
                <th>Keterangan Tunggakan</th>
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
                        <td ><?php echo $row['siswa_nama']; ?></td>
                        <td ><?php echo $row['siswa_nisn']; ?></td>
                        <td>
                        <?php

                    
                            $bulan = array(
                                    'Januari',
                                    'Februari',
                                    'Maret',
                                    'April',
                                    'Mei',
                                    'Juni',
                                    'Juli',
                                    'Agustus',
                                    'September',
                                    'Oktober',
                                    'November',
                                    'Desember');
                            
                            $query= $this->Spp_model->get_tahun($row['kode_siswa']);

                            $tgl = explode('-', $row['siswa_tgl_masuk']);
                            $thn_masuk = $tgl['0'];
                            $bulan_masuk = $tgl['1'];
                            $batas_tunggakan = 20;

                            $thn_skr = date('Y');
                            $bulan_skr = date('m');
                            $tgl_skr = date('d');
                            $angka = null;
                            $ket = null;

                            $tunggakan = 'Tidak Ada Tunggakan';
                            foreach ($query as $tahun) {
                                $query2= $this->Spp_model->get_butun($row['kode_siswa'], $tahun['tahun']);


                                if ($thn_masuk == $tahun['tahun'] and count($query) >1 and $tgl_skr > $batas_tunggakan) {
                                    for($x=$bulan_masuk-1;$x<12;$x++){
                                        foreach ($query2 as $key) {
                                            if ($bulan[$x] == $key['bulan']) {
                                                unset($bulan[$x]);
                                                break;
                                            }
                                        }
                                    }

                                    for($a=$bulan_masuk-1;$a<12;$a++){      
                                            if (isset($bulan[$a])) {
                                                echo ' '.$bulan[$a].' '.$tahun['tahun'];
                                                $tunggakan = null;
                                            }
                                    }

                                }
                                elseif ($thn_masuk == $tahun['tahun'] and count($query) ==1 and $tgl_skr > $batas_tunggakan) {
                                    for($x=$bulan_masuk-1;$x<$bulan_skr;$x++){
                                        foreach ($query2 as $key) {
                                            if ($bulan[$x] == $key['bulan']) {
                                                unset($bulan[$x]);
                                                break;
                                            }
                                        }
                                    }

                                    for($a=$bulan_masuk-1;$a<$bulan_skr;$a++){      
                                            if (isset($bulan[$a])) {
                                                echo ' '.$bulan[$a].' '.$tahun['tahun'];
                                                $tunggakan = null;
                                            }
                                    }

                                }
                              
                                else{
                                    $bulan = array(
                                    'Januari',
                                    'Februari',
                                    'Maret',
                                    'April',
                                    'Mei',
                                    'Juni',
                                    'Juli',
                                    'Agustus',
                                    'September',
                                    'Oktober',
                                    'November',
                                    'Desember');
                                    for($x=0;$x<$bulan_skr-1;$x++){
                                        foreach ($query2 as $key) {
                                            if ($bulan[$x] == $key['bulan']) {
                                                unset($bulan[$x]);
                                                break;
                                            }
                                        }
                                    }

                                    for($a=0;$a<$bulan_skr-1;$a++){      
                                            if (isset($bulan[$a])) {
                                                echo ' '.$bulan[$a].' '.$tahun['tahun'];
                                                $tunggakan = null;
                                            }
                                    }
                                }
                            }
                            echo $tunggakan;
                        ?>
                        

                        </td>


                            
                            
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