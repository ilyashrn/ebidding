<script>
$("#register_form").validate();
</script>
<section class="main-container col1-layout">
    <div class="main container">
      <div class="account-login">
        <div class="page-title">
          <h2>Daftar baru</h2>
        </div>
        <fieldset class="col2-set">
          <div class="col-1">
            <strong>Selamat datang di E-bidding.</strong>
            <p>E-bidding merupakan e-commerce yang digabungkan dengan konsep dutch auction, dimana kamu bisa menawar barang yang kamu inginkan
            secara langsung di website dan membiarkan penawar lainnya melihat variasi penawaran yang sedan terjadi. </p>
          </div>
          <div class="col-2 registered-users">
            <div class="content">
            <?php if ($this->session->flashdata('warn')) { ?>
              <div class="alert alert-danger"><?php echo $this->session->flashdata('warn'); ?></div>
            <?php } ?>
              <ul class="form-list">
                <?php 
                $attributes = array('id' => 'register_form');
                echo form_open('members/create_process',$attributes); ?>
                <li>
                  <label for="fullname">Nama lengkap<span class="required">*</span></label>
                  <input type="text" class="input-text required-entry" value="<?php echo $this->session->flashdata('fullname'); ?>" name="fullname" required>
                </li>
                <li>
                  <label for="username">Username<span class="required">*</span></label>
                  <input type="text" class="input-text required-entry" value="<?php echo $this->session->flashdata('username'); ?>" name="username" required="required">
                </li>
                <li>
                  <label for="email">Email<span class="required">*</span></label>
                  <input type="email" value="<?php echo $this->session->flashdata('email'); ?>" class="input-text required-entry" name="email">
                  <div class="help-block with-errors"></div>
                </li>
                <li>
                  <label for="pass">Password <span class="required">*</span></label>
                  <input type="password" title="Password" id="password" class="input-text required-entry validate-password" name="password" required>
                </li>
                <li>
                  <label for="conf_pass">Ulangi password <span class="required">*</span></label>
                  <input type="password"  id="confirm_password" class="input-text required-entry validate-password" name="conf_password" required>
                  <span id='message'></span>
                </li>
              </ul>
              <p class="required">* Required Fields</p>
              <div class="buttons-set">
                <button id="send2" name="send" type="submit" class="button login"><span>Daftar</span></button>
                <a class="forgot-word" href="">Forgot Your Password?</a> 
              </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </fieldset>
      </div>
      <br>
      <br>
      <br>
      <br>
      <br>
    </div>
  </section>