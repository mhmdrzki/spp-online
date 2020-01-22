<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="col-md-12 main">
            <h3>
                Detail Profil
                <span class=" pull-right">
                    <a href="<?php echo site_url('admin/profile/edit/') ?>" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>&nbsp; Edit</a> 
                </span>
            </h3><br>
        </div>
        <div class="col-md-12">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>Nama Singkat</td>
                        <td>:</td>
                        <td><?php echo $user['username'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td><?php echo $user['nama_lengkap'] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo $user['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Daftar</td>
                        <td>:</td>
                        <td><?php echo pretty_date($user['input_date'], 'l, d m Y', FALSE) ?></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
