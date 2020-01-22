<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <?php echo form_open(current_url()); ?>
        <?php echo validation_errors(); ?>
        <div class="form-group">
            <?php if ($this->uri->segment(3) == 'cpw') { ?>
                <label >Password Lama *</label>
                <input type="password" name="user_current_password" class="form-control" placeholder="Password Lama">
            <?php } ?>
        </div>
        <div class="form-group">
            <label >Password Baru *</label>
            <input type="password" name="password" class="form-control" placeholder="Password Baru">
            <?php if ($this->uri->segment(3) == 'cpw') { ?>
                <input type="hidden" name="id_admin" value="<?php echo $this->session->userdata('id_admin'); ?>" >
            <?php } else { ?>
                <input type="hidden" name="id_admin" value="<?php echo $user['id_admin'] ?>" >
            <?php } ?>
        </div>
        <div class="form-group">
            <label >Konfirmasi Password Baru*</label>
            <input type="password" name="passconf" class="form-control" placeholder="Konfirmasi Password Baru" >
        </div>
        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
        <a href="<?php echo site_url('admin/user'); ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Batal</button></a>
        <?php form_close() ?>
    </div>
</div>