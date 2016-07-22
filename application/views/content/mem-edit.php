<!-- main-container -->
  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-sm-9 wow bounceInUp animated">
        <div class="col-main">
          <div class="page-title">
            <h1>Ubah profil</h1>
          </div>
          <ol class="one-page-checkout" id="checkoutSteps">
            <li id="informasi-dasar" class="section allow active">
              <div class="step-title"> <span class="number">1</span>
                <h3>Informasi dasar</h3>
              </div>
              <div id="informasi-dasar" class="step a-item" style="">
                <?php if ($this->session->flashdata('warn')) { ?>
                  <div class="alert alert-danger"><?php echo $this->session->flashdata('warn'); ?></div>
                <?php } ?>
                <?php
                $attributes = array('id' => "shipping-zip-form", 'style' => "width: 70%;");
                echo form_open_multipart('members/edit_process', $attributes); ?>
                    <ul class="form-list">
                      <li style="margin-bottom: 10px;">
                        <label>Nama lengkap</label>
                        <div class="input-box">
                          <input value="<?php echo $mem_detail->fullname ?>" name="fullname" class="input-text validate-postcode" type="text" required>
                          <input type="hidden" value="<?php echo $mem_detail->id_member; ?>" name="current_id"></input>
                        </div>
                      </li>
                      <li style="margin-bottom: 10px;">
                        <label>Username</label>
                        <div class="input-box">
                          <input value="<?php echo $mem_detail->username; ?>" name="username" class="input-text validate-postcode" type="text" required>
                          <input type="hidden" value="<?php echo $mem_detail->username; ?>" name="current_username"></input>
                        </div>
                      </li>
                      <li style="margin-bottom: 10px;">
                        <label>E-mail</label>
                        <div class="input-box">
                          <input value="<?php echo $mem_detail->email; ?>" name="email" class="input-text validate-postcode" type="text" required>
                          <input type="hidden" value="<?php echo $mem_detail->email; ?>" name="current_email"></input>
                        </div>
                      </li>
                      <li style="margin-bottom: 10px;">
                        <label>Avatar</label>
                        <div style="width: 100px;float: left;">
                          <img style="width: auto;height: auto;max-width: 80%;vertical-align: middle;" src="<?php echo ($mem_detail->avatar!=='') ? base_url().'assets/img/avatar/'.$mem_detail->avatar : base_url().'assets/img/avatar/default_avatar.png';?>">
                          <input type="hidden" value="<?php echo $mem_detail->avatar ?>" name="cur_avatar"></input>
                        </div>
                        <div class="input-box">
                          <input type="file" name="avatar"></input>
                        </div>
                      </li>
                    </ul>
              </div>
            </li>
            <li id="alamat-kontak" class="section">
              <div class="step-title"> <span class="number">2</span>
                <h3 class="one_page_heading"> Alamat dan Kontak</h3>
              </div>
              <div id="alamat-kontak" class="step a-item">
                <div id="shipping-zip-form">
                  <ul class="form-list" style="width: 70%;">
                      <li style="margin-bottom: 10px;">
                        <label>Alamat</label>
                        <div class="input-box">
                          <input type="text" value="<?php echo $mem_detail->address; ?>" name="address" class="input-text validate-postcode" type="text">
                        </div>
                      </li>
                      <li>
                        <div class="col-md-6" style="margin-bottom: 10px;padding-left: 0px;">
                          <label>Kota</label>
                          <div class="input-box">
                            <input value="<?php echo $mem_detail->city; ?>" name="city" class="input-text validate-postcode" type="text">
                          </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom: 10px; padding-left: 0px;">
                          <label>Provinsi</label>
                          <div class="input-box">
                            <input value="<?php echo $mem_detail->province; ?>" name="province" class="input-text validate-postcode" type="text">
                          </div>  
                        </div>
                      </li>
                      <li style="margin-bottom: 10px;">
                        <div class="col-md-6" style="padding-left: 0px;">
                          <label>Kode pos</label>
                          <div class="input-box">
                            <input value="<?php echo $mem_detail->postal_code; ?>" name="postal_code" class="input-text validate-postcode" type="number">
                          </div>
                        </div>
                        <div class="col-md-6" style="padding-left: 0px;">
                          <label>Nomor handphone</label>
                          <div class="input-box">
                            <input value="<?php echo $mem_detail->phone_number; ?>" name="phone_number" class="input-text validate-postcode" type="number">
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
              </div>
            </li>
            <li id="password" class="section">
              <div class="step-title"> <span class="number">3</span>
                <h3 class="one_page_heading">Password</h3>
              </div>
              <div id="password" class="step a-item">
                <div class="alert alert-warning col-md-6">
                  Isikan hanya jika kamu ingin mengganti password.
                </div>
                <div id="shipping-zip-form">
                  <ul class="form-list" style="width: 70%;">
                      <li>
                        <div class="col-md-6" style="margin-bottom: 10px;padding-left: 0px;">
                          <label>Old Password</label>
                          <div class="input-box">
                            <input value="" name="old_pass" class="input-text validate-postcode" type="password">
                            <input type="hidden" value="<?php echo $mem_detail->password ?>" name="old_pass_conf">
                          </div>
                        </div>
                      </li>
                      <li style="margin-bottom: 10px;">
                        <div class="col-md-6" style="padding-left: 0px;">
                          <label>New password</label>
                          <div class="input-box">
                            <input value="" name="new_pass" class="input-text validate-postcode" type="password">
                          </div>
                        </div>
                        <div class="col-md-6" style="padding-left: 0px;">
                          <label>Confirm password</label>
                          <div class="input-box">
                            <input value="" name="new_pass_conf" class="input-text validate-postcode" type="password">
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
              </div>
            </li>
            <button type="submit" name="sub_edit" class="button coupon pull-right"><span>Simpan perubahan</span></button>
            <?php echo form_close(); ?>

            <li id="password" class="section">
              <?php echo form_open('members/remove_account'); ?>
              <div class="step-title"> <span class="number">3</span>
                <h3 class="one_page_heading">Hapus akun</h3>
              </div>
              <div id="password" class="step a-item">
                <div class="alert alert-danger col-md-6">
                  Ketikkan username dan passwordmu untuk <b>menghapus akun ini.</b>
                </div>
                <div id="shipping-zip-form">
                  <ul class="form-list" style="width: 70%;">
                      <li style="margin-bottom: 10px;">
                        <div class="col-md-6" style="padding-left: 0px;">
                          <label>Username</label>
                          <div class="input-box">
                            <input value="" name="username" class="input-text validate-postcode" type="text">
                            <input type="hidden" name="id_member" value="<?php echo $mem_detail->id_member ?>">
                          </div>
                        </div>
                        <div class="col-md-6" style="padding-left: 0px;">
                          <label>password</label>
                          <div class="input-box">
                            <input value="" name="password" class="input-text validate-postcode" type="password">
                            <input type="hidden" name="current_uri" value="<?php echo $this->uri->uri_string(); ?>">
                          </div>
                        </div>
                      </li>
                      <button style="margin-top:10px;" type="submit" name="sub_edit" class="button coupon pull-right"><span>Hapus akun</span></button>
                    </ul>
                  </div>
              </div>
              <?php echo form_close(); ?>
            </li>
          </ol>
        </div>
      </section>