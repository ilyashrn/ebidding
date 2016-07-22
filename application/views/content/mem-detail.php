<!-- main-container -->
  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-sm-9 wow bounceInUp animated">
        <div class="col-main">
          <div class="my-account">
            <div class="page-title">
              <h2><?php echo $mem_detail->fullname.' / '.$mem_detail->username; ?></h2>
            </div>
            <div class="dashboard">
              <div class="box-account">
                <div class="page-title">
                  <h2>Account Information</h2>
                  <?php if ($this->session->flashdata('msg')) { ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('msg'); ?></div>  
                  <?php } ?>
                </div>
                <div class="col-xs-3">
                    <img style="width: auto;height: auto;max-width: 100%;vertical-align: middle;" src="<?php echo ($mem_detail->avatar!=='') ? base_url().'assets/img/avatar/'.$mem_detail->avatar : base_url().'assets/img/avatar/default_avatar.png';?>">
                </div>
                <div class="col2-set">
                  <div class="col-1">
                    <h5>Contact Information</h5>
                    <a href="../edit_profile/<?php echo $mem_detail->id_member.'/'.$mem_detail->username;?>">Edit</a>
                    <p> nama lengkap : <?php echo $mem_detail->fullname; ?><br>
                      username : <?php echo $mem_detail->username; ?><br>
                      email : <?php echo $mem_detail->email; ?><br>
                      phone : <?php echo ($mem_detail->phone_number) ? $mem_detail->phone_number : '-'; ?><br>
                      <a href="#">Change Password</a> </p>
                  </div>
                  <div class="col-2">
                    <h5>Address information</h5>
                    <address>
                    <?php echo ($mem_detail->address) ? $mem_detail->address : '-';?><br>
                    <?php echo ($mem_detail->city) ? $mem_detail->city.', '.$mem_detail->province : '';?><br>
                    <?php echo $mem_detail->postal_code; ?><br>
                    <a href="../edit_profile/<?php echo $mem_detail->id_member.'/'.$mem_detail->username;?>">Edit Address</a>
                    </address>
                </div>
              </div>
            </div>
          </div> </div>
        </section>