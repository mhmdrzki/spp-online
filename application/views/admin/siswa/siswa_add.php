<?php
$this->load->view('admin/tinymce_init');
$this->load->view('admin/datepicker');
if (isset($siswa)) {
    $id = 1;
    $kode_siswa = $siswa['kode_siswa'];
    $inputFullName = $siswa['siswa_nama'];
    $inputBirthPlace = $siswa['siswa_tmpt_lhr'];
    $inputBirthDate = $siswa['siswa_tgl_lhr'];
    $inputNis = $siswa['siswa_nisn'];
    $inputJK = $siswa['siswa_jk'];
    $inputMasuk = $siswa['siswa_tgl_masuk'];
} else {
    $id = set_value('id');
    $inputNis = set_value('siswa_nisn');
    $inputFullName = set_value('siswa_nama');
    $inputBirthPlace = set_value('siswa_tmpt_lhr');
    $inputBirthDate = set_value('siswa_tgl_lhr');
    $inputJK = set_value('siswa_jk');
    $inputMasuk = set_value('siswa_tgl_masuk');
   
}
?>
<?php echo isset($alert) ? ' ' . $alert : null; ?>
<?php echo validation_errors(); ?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="col-lg-12">
            <h3><?php echo $operation ?> Siswa </h3>
            <br>
        </div>
        <!-- /.col-lg-12 -->

        <?php echo form_open_multipart(current_url()); ?>
        <div class="col-md-12">
            <div class="col-sm-12 col-md-9">
                <?php if (isset($siswa)): ?>
                    <input type="hidden" name="id_siswa" value="<?php echo $id ?>" />
                <?php endif; ?>

                <label >Kode Siswa *</label>
                <input type="text" name="kode_siswa" placeholder="Kode Siswa" class="form-control" value="<?php echo $kode_siswa; ?>" readonly><br>

                <label >NISN *</label>
                <input type="text" name="siswa_nisn" placeholder="NISN" class="form-control" value="<?php echo $inputNis; ?>"><br>
                

                <label >Nama Lengkap *</label> 
                <input type="text" name="siswa_nama" placeholder="Nama Lengkap" class="form-control" value="<?php echo $inputFullName; ?>"><br>
                <label >Tempat Lahir *</label>
                <input type="text" name="siswa_tmpt_lhr" placeholder="Tempat Lahir" class="form-control" value="<?php echo $inputBirthPlace; ?>"><br>
                <label >Tanggal Lahir *</label>
                <input type="text" name="siswa_tgl_lhr" placeholder="Tanggal Lahir" class="form-control datepicker" value="<?php echo $inputBirthDate; ?>"><br>
                <label >Jenis Kelamin *</label>
                <input type="text" name="siswa_jk" placeholder="Jenis Kelamin" class="form-control" value="<?php echo $inputJK; ?>"><br>
                <label >Tanggal Masuk *</label>
                <input type="text" name="siswa_tgl_masuk" placeholder="Tanggal Masuk" class="form-control datepicker" value="<?php echo $inputMasuk; ?>"><br>

                <p style="color:#9C9C9C;margin-top: 5px"><i>*) Wajib diisi</i></p>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-3">
                <div class="form-group">
                    
                    <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button><br>
                    <a href="<?php echo site_url('admin/siswa'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a><br>
                   
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

            <?php if (isset($siswa)): ?>
                <!-- Delete Confirmation -->
<!--                 <div class="modal fade" id="confirm-del">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><b>Konfirmasi Penghapusan</b></h4>
                            </div>
                            <div class="modal-body">
                                <p>Data yang dipilih akan dihapus oleh sistem, apakah anda yakin?;</p>
                            </div>
                            <?php echo form_open('admin/siswa/delete/' . $siswa['siswa_id']); ?>
                            <div class="modal-footer">
                                <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button></a>
                                <input type="hidden" name="del_id" value="<?php echo $siswa['siswa_id'] ?>" />
                                <input type="hidden" name="del_name" value="<?php echo $siswa['siswa_nama'] ?>" />
                                <button type="submit" class="btn btn-primary">Ya</button>
                            </div>
                            <?php echo form_close(); ?>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal --> -->
                <?php if ($this->session->flashdata('delete')) { ?>
                    <script type = "text/javascript">
                        $(window).load(function() {
                            $('#confirm-del').modal('show');
                        });
                    </script>
                    <?php }
                    ?>
                <?php endif; ?>

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