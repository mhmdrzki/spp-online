<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="col-md-12 main">
            <h3>
                Detail Siswa
                <span class=" pull-right">
                    <a href="<?php echo site_url('admin/siswa') ?>" class="btn btn-info btn-sm"><span class="fa fa-arrow-left"></span>&nbsp; Kembali</a> 
                    <a href="<?php echo site_url('admin/siswa/edit/' . $siswa['kode_siswa']) ?>" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>&nbsp; Edit</a>
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
                        <td>NISN</td>
                        <td>:</td>
                        <td><?php echo $siswa['siswa_nisn'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td><span class="cap"><?php echo $siswa['siswa_nama'] ?></span></td>
                    </tr>
                    <tr>
                        <td>Tempat/Tanggal Lahir</td>
                        <td>:</td>
                        <td><?php echo $siswa['siswa_tmpt_lhr'] . ', ' . pretty_date($siswa['siswa_tgl_lhr'], 'd F Y', FALSE) ?></td>
                    </tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><span class="cap"><?php echo $siswa['siswa_jk'] ?></span></td>
                    </tr>
                    </tr>
                        <td>Tanggal Masuk</td>
                        <td>:</td>
                        <td><span class="cap"><?php echo pretty_date($siswa['siswa_tgl_masuk'], 'd F Y', FALSE) ?></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
