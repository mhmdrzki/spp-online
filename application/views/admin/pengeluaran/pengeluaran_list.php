<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <h3 class="">
            Pengeluaran
            <a href="<?php echo site_url('admin/pengeluaran/add'); ?>" ><span class="glyphicon glyphicon-plus-sign"></span></a>
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
            <input autofocus type="text" name="n" id="field" placeholder="No. Pengeluaran" class="form-control">            
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
                <th>Kode Pengeluaran</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Biaya</th>
                <th>Bendahara</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php				
        $i =1;
        if (!empty($pengeluaran)) {
            foreach ($pengeluaran as $row) {
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td ><?php echo $row['kode_keluar']; ?></td>
                        <td ><?php echo $row['tgl_pengeluaran']; ?></td>
                        <td ><?php echo $row['ket']; ?></td>
                        <td >Rp. <?php echo $row['biaya']; ?></td>
                        <td ><?php echo $row['bendahara']; ?></td>
                        
                        
                        <td>
                            <a class="btn btn-warning btn-xs" href="<?php echo site_url('admin/pengeluaran/detail/' . $row['kode_keluar']); ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                            <a class="btn btn-success btn-xs" href="<?php echo site_url('admin/pengeluaran/add/' . $row['kode_keluar']); ?>" ><span class="glyphicon glyphicon-edit"></span></a>
                            <a class="btn btn-danger btn-xs" href="<?php echo site_url('admin/pengeluaran/delete/' . $row['kode_keluar']); ?>" ><span class="glyphicon glyphicon-trash"></span></a>

                            
                            </td>
                        </tr>
                    </tbody>
                    <?php
                    $i++;
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
