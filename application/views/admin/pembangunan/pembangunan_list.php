<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <h3 class="">
            Uang Pembangunan
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
                <th>Nama </th>
                <th>NISN</th>
                <th>Jumlah Bayar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php       
        $i=1;       
        if (!empty($siswa)) {
            foreach ($siswa as $row) {
                $nisn = $row['siswa_nisn'];
                ?>
                <tbody>
                    <tr>
                        <td ><?php echo $i ?></td>
                        <td ><?php echo $row['siswa_nama']; ?></td>
                        <td ><?php echo $row['siswa_nisn']; ?></td>
                        <td ><?php
                            
                            $jmlh_byr = null;
                            if ($this->Pembangunan_model->get(array('siswa_nisn' => $nisn))) {
                                $pembangunan = $this->Pembangunan_model->get(array('siswa_nisn' => $nisn));
                                
                                $jmlh_byr = $pembangunan['jmlh_byr'];                                
                                echo 'Rp. '.$jmlh_byr;
                            }
                            else{
                                echo 'Rp. 0';
                            }
                            
                        ?></td>
                        <td><?php echo (isset($jmlh_byr)) ? 'Lunas' : 'Belum Lunas'?></td>
                        <td>
                            <?php
                                if (isset($jmlh_byr)) {
                                    ?>
                                    <a class="btn btn-warning btn-xs" href="<?php echo site_url('admin/Pembangunan/detail/' . $row['siswa_nisn']); ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                                    <a class="btn btn-success btn-xs" href="<?php echo site_url('admin/Pembangunan/edit/' . $row['siswa_nisn']); ?>" ><span class="glyphicon glyphicon-edit"></span></a>
                                    <a class="btn btn-danger btn-xs" href="<?php echo site_url('admin/Pembangunan/delete/' . $row['siswa_nisn']); ?>" ><span class="glyphicon glyphicon-trash"></span></a>

                                    <?php
                                }
                                else{
                                     ?>
                                    <a style="margin-right: 5px; margin-left: 5px" class="btn btn-success btn-xs" href="<?php echo site_url('admin/Pembangunan/add/'.$nisn); ?>" ><b>BAYAR</b></a>

                                    <?php
                                }
                            ?>
                            
                            
                            </td>
                        </tr>
                    </tbody> <?php $i++;?>
                    <?php
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

<style type="text/css">
   .upper { text-transform: uppercase; }
   .lower { text-transform: lowercase; }
   .cap   { text-transform: capitalize; }
   .small { font-variant:   small-caps; }
</style>
