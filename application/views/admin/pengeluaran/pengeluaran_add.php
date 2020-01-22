<?php
$this->load->view('admin/tinymce_init');
$this->load->view('admin/datepicker');
if (isset($pengeluaran)) {

    $id = 1;
    $kode_keluar = $pengeluaran['kode_keluar'];
    $tgl = $pengeluaran['tgl_pengeluaran'];
    $ket = $pengeluaran['ket'];
    $biaya = $pengeluaran['biaya'];
    $bendahara = $pengeluaran['bendahara'];
    
    
} else {
    $id = set_value('id');
    $tgl = set_value('tgl_pengeluaran');
    $ket = set_value('ket');
    $biaya = set_value('biaya');
    $bendahara = set_value('bendahara');
}
?>
<?php echo isset($alert) ? ' ' . $alert : null; ?>
<?php echo validation_errors(); ?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="col-lg-12">
            <h3><?php echo $operation ?> Pengeluaran</h3>
            <br>
        </div>
        <!-- /.col-lg-12 -->

        <?php echo form_open_multipart(current_url()); ?>
        <div class="col-md-12">
            <div class="col-sm-12 col-md-9">
                <?php if (isset($pengeluaran)): ?>
                    <input type="hidden" name="id_pengeluaran" value="<?php echo $id ?>" />
                <?php endif; ?>     
                
                

                <label >Kode Pengeluaran *</label>
                <input type="text" name="kode_keluar" placeholder="Kode Transaksi" class="form-control" value="<?php echo $kode_keluar; ?>" readonly><br>
                <label >Tanggal Pengeluaran *</label>
                <input type="text" name="tgl_pengeluaran" placeholder="Tanggal Pengeluaran" class="form-control datepicker" value="<?php echo $tgl; ?>"><br>
                <label >Keterangan *</label>
                <input type="text" name="ket" placeholder="Keterangan" class="form-control" value="<?php echo $ket; ?>"></input><br>
                <label >Biaya *</label> 
                <input type="text" name="biaya" placeholder="Biaya" class="form-control" value="<?php echo $biaya; ?>"><br>
                <label >Bendahara *</label> 
                <input type="text" name="bendahara" placeholder="Nama Bendahara" class="form-control" value="<?php echo $bendahara; ?>"><br>
                <label >Bukti Pembayaran *</label>
                <input type="file" name="berkas" placeholder="Kwitansi" class="form-control"><br>
                

                <p style="color:#9C9C9C;margin-top: 5px"><i>*) Wajib diisi</i></p>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-3">
                <div class="form-group">
                    <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button><br>
                    <a href="<?php echo site_url('admin/pengeluaran'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a><br>
                    
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>

            <?php if (isset($pengeluaran)): ?>
                <!-- Delete Confirmation -->
                <div class="modal fade" id="confirm-del">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><b>Konfirmasi Penghapusan</b></h4>
                            </div>
                            <div class="modal-body">
                                <p>Data yang dipilih akan dihapus oleh sistem, apakah anda yakin?;</p>
                            </div>
                            <?php echo form_open('admin/pengeluaran/delete/' . $pengeluaran['id_pengeluaran']); ?>
                            <div class="modal-footer">
                                <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button></a>
                                <input type="hidden" name="del_id" value="<?php echo $pengeluaran['id_pengeluaran'] ?>" />
                                <input type="hidden" name="del_name" value="<?php echo $pengeluaran['siswa_nama'] ?>" />
                                <button type="submit" class="btn btn-primary">Ya</button>
                            </div>
                            <?php echo form_close(); ?>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
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