<?php
$this->load->view('admin/tinymce_init');
$this->load->view('admin/datepicker');
if (isset($pembangunan)) {
    $id = 1;
    $kode_bayar = $pembangunan['kode_bayar'];
    $tgl_byr = $pembangunan['tgl_byr'];
    $jmlh_byr = $pembangunan['jmlh_byr'];
    $bendahara = $pembangunan['bendahara'];
} else {
    $id = set_value('id');
    $tgl_byr = set_value('tgl_byr');
    $jmlh_byr = set_value('jmlh_byr');
    $bendahara = set_value('bendahara');
}

?>
<?php echo isset($alert) ? ' ' . $alert : null; ?>
<?php echo validation_errors(); ?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="col-lg-12">
            <h3> Pembayaran Uang Pembangunan</h3>
            <br>
        </div>
        <!-- /.col-lg-12 -->

        <?php echo form_open_multipart(current_url()); ?>
        <div class="col-md-12">
            <div class="col-sm-12 col-md-9">
                <?php if (isset($pembangunan)): ?>
                    <input type="hidden" name="id_pembangunan" value="<?php echo $id ?>" />
                <?php endif; ?>

                <label >No. Pembayaran *</label>
                <input type="text" name="kode_bayar" placeholder="Kode Transaksi" class="form-control" value="<?php echo $kode_bayar; ?>" readonly><br>

                <label >Nama Siswa *</label>
                <input type="text" name="nama" placeholder="Nama" class="form-control" value="<?php echo $siswa['siswa_nama']; ?>" readonly><br>

                <label >NISN *</label>
                <input type="text" name="nisn" placeholder="NISN" class="form-control" value="<?php echo $siswa['siswa_nisn']; ?>" readonly><br>

                <label >Tanggal Pembayaran *</label> 
                <input type="text" name="tgl_byr" placeholder="Tanggal Pembayaran" class="form-control datepicker" value="<?php echo $tgl_byr; ?>"><br>

                <label >Jumlah Bayar *</label>
                <input type="text" name="jml_byr" placeholder="Jumlah Bayar *ex: 100000" class="form-control" value="<?php echo $jmlh_byr; ?>"><br>

                <label >Bendahara *</label>
                <input type="text" name="bendahara" placeholder="Nama Bendahara" class="form-control" value="<?php echo $bendahara; ?>"><br>

                <label >Bukti Pembayaran *</label>
                <input type="file" name="berkas" class="form-control"><br>



                <p style="color:#9C9C9C;margin-top: 5px"><i>*) Wajib diisi</i></p>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-3">
                <div class="form-group">
                    
                    <button name="action" style="margin-top: 24px" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Bayar</button><br>
                    <a href="<?php echo site_url('admin/Pembangunan'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a><br>
                    
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>


                <script type="text/javascript">
                    function validate(evt) {
                      var theEvent = evt || window.event;
                      var key = theEvent.keyCode || theEvent.which;
                      key = String.fromCharCode( key );
                      var regex = /[0-9]|\./;
                      if( !regex.test(key) ) {
                        theEvent.returnValue = false;
                        if(theEvent.preventDefault) theEvent.preventDefault();
                    }
                }
            </script>