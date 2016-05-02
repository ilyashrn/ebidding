<script type="text/javascript">
function submitform()
{
  document.form.submit();
}
</script>

<!-- main-container -->
  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-sm-9 wow bounceInUp animated">
        <div class="col-main">
          <div class="my-account">
            <div class="page-title">
              <h2><?php echo $subtitle; ?></h2>
            </div>
          </div>
          <div class="bid-in">
            <?php if ($notifications): ?>
              <?php echo form_open('notifications/mark_all_read'); ?>
                <a href="#" onclick="$(this).closest('form').submit()" class="pull-right">Mark all as read</a>
                <input name="id_receiver" type="hidden" value="<?php echo $this->session->userdata('id'); ?>"></input>
                <input name="current_uri" type="hidden" value="<?php echo $this->uri->uri_string() ?>"></input>
              <?php echo form_close(); ?>
              
              <?php echo form_open('notifications/delete_all'); ?>
                <a href="#" onclick="$(this).closest('form').submit()" style="margin-right: 10px;" class="pull-right">Delete all</a>
                <input name="id_receiver" type="hidden" value="<?php echo $this->session->userdata('id'); ?>"></input>
                <input name="current_uri" type="hidden" value="<?php echo $this->uri->uri_string() ?>"></input>
              <?php echo form_close(); ?>
            <div class="row">
                <?php foreach ($notifications as $not): ?>
                <div class="col-md-10 bid-bar" <?php echo ($not->is_read) ? '' : 'style="background-color: #dde8f0;"'; ?>>
                  <div class="div-avatar">
                    <a href="">
                      <img style="width: 80%;" src="<?php echo (!$not->avatar) ? base_url().'assets/img/avatar/default_avatar.png' : base_url().'assets/img/avatar/'.$not->avatar;?>">
                    </a>
                  </div>
                  <p style="margin-bottom: 0px;">
                  <?php if ($not->notification_type == 'winner is set'): ?>
                    <a href="<?php echo base_url().'auctions/detail/'.$not->id_auction.'/'.$not->id_product.'#productTabContent' ?>"><strong><?php echo $not->fullname ?></strong> telah menentukan pemenang bid dari lapak <strong><?php echo $not->name; ?></strong>.
                  <?php elseif ($not->notification_type == 'you win'): ?>
                    <a href="<?php echo base_url().'auctions/detail/'.$not->id_auction.'/'.$not->id_product.'#productTabContent' ?>"><strong><?php echo $not->fullname ?></strong> telah menentukan kamu sebagai pemenang bid dari lapak <strong><?php echo $not->name; ?></strong> dan telah diberikan akses untuk melihat informasi kontak <strong><?php echo $not->fullname; ?></strong> sebagai pemilik lapak.
                  <?php elseif ($not->notification_type == 'bid in'): ?>
                    <a href="<?php echo base_url().'auctions/detail/'.$not->id_auction.'/'.$not->id_product.'#productTabContent' ?>"><strong><?php echo $not->fullname ?></strong> telah memberikan bid pada lapakmu yang berjudul <strong><?php echo $not->name; ?></strong>.
                  <?php elseif ($not->notification_type == 'another bid'): ?>
                    <a href="<?php echo base_url().'auctions/detail/'.$not->id_auction.'/'.$not->id_product.'#productTabContent' ?>"><strong><?php echo $not->fullname ?></strong> juga memmberikan bid pada lapak <strong><?php echo $not->name; ?></strong>.
                  <?php elseif ($not->notification_type == 'winner is reset'): ?>
                    <a href="<?php echo base_url().'auctions/detail/'.$not->id_auction.'/'.$not->id_product.'#productTabContent' ?>"><strong><?php echo $not->fullname ?></strong> telah membatalkan pemenang bid pada lapak <strong><?php echo $not->name; ?></strong>.  
                  <?php elseif ($not->notification_type == 'you are canceled'): ?>
                    <a href="<?php echo base_url().'auctions/detail/'.$not->id_auction.'/'.$not->id_product.'#productTabContent' ?>"><strong><?php echo $not->fullname ?></strong> telah membatalkan kamu sebagai pemenang bid pada lapak <strong><?php echo $not->name; ?></strong>.
                  <?php elseif ($not->notification_type == 'review'): ?>
                    <a href="<?php echo base_url().'auctions/detail/'.$not->id_auction.'/'.$not->id_product.'#productTabContent' ?>"><strong><?php echo $not->fullname ?></strong> memberikan review atas transaksi pada lapak <strong><?php echo $not->name; ?></strong>.
                  <?php endif ?>
                  </a>
                  </p>
                  <span class="little-span product-date"><?php echo date('F j, Y, g:i a',strtotime($not->notification_timestamp)) ; ?></span>
                </div>
                <?php endforeach ?>
              <?php else: ?>
              <div class="col-md-4">
                <div class="alert alert-warning">Tidak ada notifikasi saat ini.</div>
              </div>
              <?php endif ?>
            </div>
          </div>
        </section>