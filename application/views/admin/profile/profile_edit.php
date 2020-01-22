<?php
$this->load->view('admin/tinymce_init');
$id = $user['id_admin'];
$inputNameValue = $user['username'];
$inputJudulValue = $user['nama_lengkap'];
$inputEmailValue = $user['email'];
$inputDescValue = $user['description'];
?>
<?php echo isset($alert) ? ' ' . $alert : null; ?>
<?php echo validation_errors(); ?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="col-lg-12">
            <h3><?php echo $operation ?> Profil</h3>
            <br>
        </div>
        <!-- /.col-lg-12 -->

        <?php echo form_open_multipart(current_url()); ?>
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-9 col-md-9">
                    <input type="hidden" name="id_admin" value="<?php echo $user['id_admin'] ?>" />
                    <label >Username *</label>
                    <input name="username" type="text" <?php echo (isset($user)) ? 'readonly' : '' ?> placeholder="Username" class="form-control" value="<?php echo $inputNameValue; ?>"><br>
                    <label >Nama Lengkap *</label>
                    <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" class="form-control" value="<?php echo $inputJudulValue; ?>"><br>
                    

                    <label >Email *</label>
                    <input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $inputEmailValue; ?>">
                    <p style="color:#9C9C9C;margin-top: 5px"><i>Contoh : example@yahoo.com / example@example.com</i></p>
                    <label>Deskripsi </label>
                    <textarea name="description" class="form-control mce-init" rows="5" placeholder="Deskripsi pengguna"><?php echo $inputDescValue; ?></textarea><br>
                    <p style="color:#9C9C9C;margin-top: 5px"><i>*) Wajib diisi</i></p>
                </div>
                <div class="col-sm-9 col-md-3">
                    <div class="form-group">
                        <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button><br>
                        <a href="<?php echo site_url('admin/profile'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a><br>
                        <?php if (isset($user)): ?>
                            <?php if ($this->session->userdata('id_admin') == $id) {
                                ?>
                                <a href="<?php echo site_url('admin/profile/cpw') ?>" class="btn btn-primary btn-form"><i class="fa fa-refresh"></i> Ubah Password</a><br>
                            <?php } elseif ($this->session->userdata('id_admin') != $id) { ?>
                                <a class="btn btn-primary btn-form" href="<?php echo site_url('admin/user/rpw/' . $user['id_admin']); ?>" ><i class="fa fa-key"></i> Reset Password</a><br>
                            <?php } ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>