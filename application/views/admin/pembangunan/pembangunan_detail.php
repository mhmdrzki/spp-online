<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="col-md-12 main">
            <h3>
                Detail Uang Pembangunan
                <span class=" pull-right">
                    <a href="<?php echo site_url('admin/pembangunan') ?>" class="btn btn-info btn-sm"><span class="fa fa-arrow-left"></span>&nbsp; Kembali</a> 
                    <a href="<?php echo site_url('admin/pembangunan/edit/' . $siswa['siswa_nisn']) ?>" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>&nbsp; Edit</a>
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
                        <td><span class="cap"><?php echo $pembangunan['kode_bayar'] ?></span></td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td><span class="cap"><?php echo $siswa['siswa_nama'] ?></span></td>
                    </tr>
                    <tr>
                        <td>NISN</td>
                        <td>:</td>
                        <td><?php echo $siswa['siswa_nisn'] ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Pembayaran</td>
                        <td>:</td>
                        <td><?php echo pretty_date($pembangunan["tgl_byr"], 'd F Y', FALSE) ?></td>
                    </tr>
                        <td>Jumlah Bayar</td>
                        <td>:</td>
                        <td><?php echo 'Rp. '.$pembangunan["jmlh_byr"]; ?></td>
                    </tr>
                    </tr>
                        <td>Bendahara</td>
                        <td>:</td>
                        <td><?php echo $pembangunan["bendahara"]; ?></td>
                    </tr>
                    <tr>
                        <td>Bukti Pembayaran</td>
                        <td>:</td>
                        <td><img style="width: 300px; height: 280px" src="<?php echo base_url() ?>/img/<?php echo $pembangunan['bukti_bayar'] ?>"></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
