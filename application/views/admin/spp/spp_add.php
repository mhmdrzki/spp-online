<?php
$this->load->view('admin/tinymce_init');
$this->load->view('admin/datepicker');
if (isset($spp)) {
    $id = 1;
    $kode_trans = $spp['kode_bayar'];
    $kode_siswa = $spp['kode_siswa'];
    $tgl = $spp['tgl_byr'];
    $biaya_spp = $spp['biaya_spp'];
    $total_biaya = $spp['total_biaya'];
    $bendahara = $spp['bendahara'];
} else {
    $id   = set_value('id');
    $tgl = set_value('tgl_byr');
    $bulan_spp = set_value('bulan_spp');
    $tahun_spp = set_value('tahun_spp');
    $biaya_spp = set_value('biaya_spp');
    $total_biaya = set_value('total_biaya');
    $bendahara = set_value('bendahara');
}
?>
<?php echo isset($alert) ? ' ' . $alert : null; ?>
<?php echo validation_errors(); ?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="col-lg-12">
            <h3><?php echo $operation ?> Pembayaran SPP</h3>
            <br>
        </div>
        <!-- /.col-lg-12 -->

        <?php echo form_open_multipart(current_url()); ?>
        <div class="col-md-12">
            <div class="col-sm-12 col-md-9">
                <?php if (isset($spp)): ?>
                    <input type="hidden" name="id_spp" value="<?php echo $id ?>" />
                <?php endif; ?>     
                
                
                
                <label >No. Pembayaran *</label>
                <input type="text" name="kode_bayar" placeholder="Kode Transaksi" class="form-control" value="<?php echo $kode_trans; ?>" readonly><br>
                <label >Siswa *</label>
                <select name="kode_siswa" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
                            <?php
                            $siswa = $this->Siswa_model->get();
                            
                            foreach ($siswa as $row) {
                                    if ($row['kode_siswa'] == $kode_siswa) {
                                    ?>
                                        <option value="<?php echo $row['kode_siswa']; ?>" selected><?php echo $row['siswa_nisn'];?> (<?php echo $row['siswa_nama'];?>)</option>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <option value="<?php echo $row['kode_siswa']; ?>"><?php echo $row['siswa_nisn'];?> (<?php echo $row['siswa_nama'];?>)</option>
                                        <?php
                                    }
                                }
                                    
                              
                            ?>
                </select><br><br>
                <label >Tanggal Pembayaran *</label>
                <input type="text" name="tgl_byr" placeholder="Tanggal Pembayaran" class="form-control datepicker" value="<?php echo $tgl; ?>"><br>
                <label >Bulan SPP *</label>
                <select  name="bulan_spp[]" id="bulan" class="form-control" multiple>
                    <?php 

                        $detail = $this->Spp_model->getdetail(array('kode_bayar' => $kode_trans));

                        $a=null;
                        foreach ($bulan_select as $key) {
                            foreach ($detail as $key2) {
                                if ($key == $key2['bulan']) {
                                    $a=1;                               
                                }
                                
                            }
                            if ($a==1) {
                                echo "<option selected>".$key."</option>";
                                $a=null;
                            }
                            else{
                                echo "<option>".$key."</option>";
                            }
                        }
                        $tahun_spp = $key2['tahun'];
                    ?>
                </select><br><br>
                <label >Tahun Ajaran *</label>
                <input type="text" name="tahun_spp" placeholder="Tahun Ajaran" class="form-control" value="<?php echo $tahun_spp; ?>"><br>
                <label >Biaya SPP *</label> 
                <input type="text" name="biaya_spp" placeholder="Biaya SPP" class="form-control" value="<?php echo $biaya_spp; ?>"><br>
                <label >Total Biaya *</label> 
                <input type="text" name="total_biaya" placeholder="Total Biaya" class="form-control" value="<?php echo $total_biaya; ?>"><br>
                <label >Bendahara *</label>
                <input type="text" name="bendahara" placeholder="Nama Bendahara" class="form-control" value="<?php echo $bendahara; ?>"><br>
                <label >Bukti Pembayaran *</label>
                <input type="file" name="berkas" class="form-control"><br>
                

                

                <p style="color:#9C9C9C;margin-top: 5px"><i>*) Wajib diisi</i></p>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-3">
                <div class="form-group">
                    <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button><br>
                    <a href="<?php echo site_url('admin/spp'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a><br>
                    
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>

            <?php if (isset($spp)): ?>
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
                            <?php echo form_open('admin/spp/delete/' . $spp['spp_id']); ?>
                            <div class="modal-footer">
                                <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button></a>
                                <input type="hidden" name="del_id" value="<?php echo $spp['spp_id'] ?>" />
                                <input type="hidden" name="del_name" value="<?php echo $spp['siswa_nama'] ?>" />
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


            <script>
            $(document).ready(function () {
                $("#bulan").select2({
                    placeholder: "Please Select"
                });
            });
            </script>