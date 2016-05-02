
  <section class="main-container col1-layout">
    <div class="main container">
      <div class="account-login">
        <div class="page-title">
          <h2>Iklan berhasil dibuat</h2>
        </div>
        <fieldset class="col2-set">
          <div class="container">
            <div class="row">
              <div class="col-xs-12" style="margin-top: 30px;">
                <p style="text-align: center;">Selamat, Iklan berhasil dibuat dan dapat kamu lihat <a href="<?php echo base_url().'auctions/detail/'.$this->session->flashdata('success')?>">di sini</a>. Untuk melakukan perubahan pada iklan silahkan buka <a href="<?php echo base_url().'members/detail/'.$this->session->userdata('username')?>">halaman profilmu</a>.</p>
              </div>
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