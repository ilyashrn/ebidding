<!-- main-container -->
  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-sm-9 wow bounceInUp animated">
        <div class="col-main">
          <div class="my-account">
            <div class="page-title">
              <h2><?php echo $mem_detail->fullname.' / '.$mem_detail->username; ?> - <?php echo $subtitle; ?></h2>
            </div>
          </div>
          <div class="bid-in">
            <div class="row">
            <?php if ($bids): ?>
              <?php foreach ($bids as $bid): ?>
                <div class="row bid-bar">
                  <div class="col-md-1">
                    <div>
                    <?php if ($subtitle !== 'Bid Keluar'): ?>
                      <a href="<?php echo base_url().'members/detail/'.$bid->bidder_username; ?>">
                        <img style="width: 100%;" src="<?php echo ($bid->bidder_avatar!=='') ? base_url().'assets/img/avatar/'.$bid->bidder_avatar : base_url().'assets/img/avatar/default_avatar.png';?>">
                      </a>
                    <?php else: ?>
                      <a href="<?php echo base_url().'members/detail/'.$bid->auct_username; ?>">
                        <img style="width: 100%;" src="<?php echo ($bid->auct_avatar!=='') ? base_url().'assets/img/avatar/'.$bid->auct_avatar : base_url().'assets/img/avatar/default_avatar.png';?>">
                      </a>
                    <?php endif ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <h2 class="product-title"><a href="<?php echo base_url().'auctions/detail/'.$bid->id_auction.'/'.$bid->id_product.'#bid-'.$bid->id_bid ?>"><?php echo $bid->name; ?></a> </h2>
                    <?php if ($subtitle == 'Bid Keluar'): ?>
                    Actioneer : <a href="<?php echo base_url().'members/detail/'.$bid->auct_username; ?>"><strong><?php echo $bid->auct_fullname.' ('.$bid->auct_username.')'; ?></strong></a><br>
                  <?php else: ?>
                    Bidder : <a href="<?php echo base_url().'members/detail/'.$bid->bidder_username; ?>"><strong><?php echo $bid->bidder_fullname.' ('.$bid->bidder_username.')'; ?></strong></a><br>
                    <?php endif ?>
                    Bid value : <strong>Rp <?php echo number_format($bid->bid_value) ?></strong> <br>
                    <?php echo $bid->bid_timestamp; ?>
                  </div>
                  <div class="col-md-4">
                    <span class="label label-info pull-right"><?php echo $bid->category_name ?> // <?php echo $bid->sub_name ?></span>
                    <?php if ($bid->id_winner == $bid->id_bid): ?>
                    <br><span class="label label-warning pull-right">Winner</span>
                    <?php endif ?>
                  </div>
                </div>
              <?php endforeach ?>
            <?php else: ?>
              <div class="col-md-4">
                <div class="alert alert-warning">Tidak ada bid saat ini.</div>
              </div>
            <?php endif ?>
            </div>
          </div>
        </section>