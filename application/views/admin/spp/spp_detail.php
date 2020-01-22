<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="col-md-12 main">
            <h3>
                Detail Pembayaran Spp
                <span class=" pull-right">
                    <a href="<?php echo site_url('admin/spp') ?>" class="btn btn-info btn-sm"><span class="fa fa-arrow-left"></span>&nbsp; Kembali</a> 
                    <a href="<?php echo site_url('admin/spp/add/' . $spp['kode_bayar']) ?>" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>&nbsp; Edit</a>
                </span>
            </h3><br>
        </div>
		<style type="text/css">
   .upper { text-transform: uppercase; }
   .lower { text-transform: lowercase; }
   .cap   { text-transform: capitalize; }
   .small { font-variant:   small-caps; }
</style>
        <div class="col-md-8">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>No. Pembayaran</td>
                        <td>:</td>
                        <td><?php echo $spp['kode_bayar'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama Siswa</td>
                        <td>:</td>
                        <?php
                        $siswa = $this->Siswa_model->get(array('kode_siswa' => $spp['kode_siswa']));
                        ?>
                        <td><span class="cap"><?php echo $siswa['siswa_nama']." (".$siswa['siswa_nisn'].")"; ?></span></td>
                    </tr>
                    <tr>
                        <td>Tanggal Bayar</td>
                        <td>:</td>
                        <td><span class="cap"><?php echo $spp['tgl_byr'] ?></span></td>
                    </tr>
                    <tr>
                        <?php
                            $detail = $this->Spp_model->getdetail(array('kode_bayar' => $spp['kode_bayar']));
                            
                        ?>
                        
                        <td>Bulan SPP</td>
                        <td>:</td>
                        <td ><?php foreach ($detail as $key) {
                                echo $key['bulan'].'<br>';
                            }
                             ?></td>
                    </tr>
                    <tr>
                        <td>Biaya SPP</td>
                        <td>:</td>
                        <td><span class="cap">Rp. <?php echo $spp['biaya_spp'] ?></span></td>
                    </tr>
                    <tr>
                        <td>Total Biaya</td>
                        <td>:</td>
                        <td><span class="cap">Rp. <?php echo $spp['total_biaya'] ?></span></td>
                    </tr>
                    <tr>
                        <td>Nama Bendahara</td>
                        <td>:</td>
                        <td><span class="cap"><?php echo $spp['bendahara'] ?></span></td>
                    </tr>
                    <tr>
                        <td>Bukti Pembayaran</td>
                        <td>:</td>
                        <td><img style="width: 300px; height: 280px" src="<?php echo base_url() ?>/img/<?php echo $spp['bukti_bayar'] ?>"></span></td>
                    </tr>
                    
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
