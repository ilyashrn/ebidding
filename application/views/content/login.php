<section class="main-container col1-layout">
    <div class="main container">
      <div class="account-login">
        <div class="page-title">
          <h2>Login atau Daftar baru</h2>
        </div>
        <fieldset class="col2-set">
          <div class="col-1 new-users"><strong>User baru</strong>
            <div class="content">
              <p>Dengan melakukan pendaftaran pada e-commerce ini, anda bisa menawar barang yang anda inginkan secara langsung.</p>
              <div class="buttons-set">
                <a href="create_account" class="button create-account" type="button"><span>CREATE AN ACCOUNT</span></a>
              </div>
            </div>
          </div>
          <div class="col-2 registered-users"><strong>Registered User</strong>
            <div class="content">
            <?php if ($this->session->flashdata('warn')) { ?>
              <div class="alert alert-danger"><?php echo $this->session->flashdata('warn'); ?></div>
            <?php } ?>
              <p>Masukkan username atau e-mail anda beserta password.</p>
              <ul class="form-list">
                <?php echo form_open('main/login_process'); ?>
                <li>
                  <label for="email">Email / Username<span class="required">*</span></label>
                  <input type="text" title="Email Address" class="input-text required-entry" value="" name="login_id" required>
                </li>
                <li>
                  <label for="pass">Password <span class="required">*</span></label>
                  <input type="password" title="Password" id="pass" class="input-text required-entry validate-password" name="password" required>
                </li>
              </ul>
              <p class="required">* Required Fields</p>
              <div class="buttons-set">
                <button id="send2" name="send" type="submit" class="button login"><span>Login</span></button>
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