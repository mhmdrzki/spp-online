<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="col-md-12 main">
            <h3>
                Detail Pengeluaran
                <span class=" pull-right">
                    <a href="<?php echo site_url('admin/pengeluaran') ?>" class="btn btn-info btn-sm"><span class="fa fa-arrow-left"></span>&nbsp; Kembali</a> 
                    <a href="<?php echo site_url('admin/pengeluaran/edit/' . $pengeluaran['kode_keluar']) ?>" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>&nbsp; Edit</a>
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
                        <td>Tanggal Pengeluaran</td>
                        <td>:</td>
                        <td><?php echo $pengeluaran['kode_keluar'] ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Pengeluaran</td>
                        <td>:</td>
                        <td><?php echo $pengeluaran['tgl_pengeluaran'] ?></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td><span class="cap"><?php echo $pengeluaran['ket'] ?></span></td>
                    </tr>
                    <tr>
                        <td>Biaya</td>
                        <td>:</td>
                        <td><span class="cap">Rp. <?php echo $pengeluaran['biaya'] ?></span></td>
                    </tr>
                    <tr>
                        <td>Nama Bendahara</td>
                        <td>:</td>
                        <td><span class="cap">Rp. <?php echo $pengeluaran['bendahara'] ?></span></td>
                    </tr>
                    <tr>
                        <td>Bukti Pembayaran</td>
                        <td>:</td>
                        <td><img style="width: 300px; height: 280px" src="<?php echo base_url() ?>/img/<?php echo $pengeluaran['bukti_bayar'] ?>"></span></td>
                    </tr>
                    
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
