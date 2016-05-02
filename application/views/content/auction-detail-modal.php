<!-- Modal bid -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Place Your Bid</h4>
      </div>
      <div class="modal-body">
        <span><strong>Kelipatan bid</strong> yang diperbolehkan pada lapak ini adalah <strong><?php echo number_format($auction_detail->bid_interval) ;?></strong></span><br>
        <div class="bid-form">
          <?php echo form_open('auctions/set_bid'); ?>
            <label for="coupon_code">Masukkan bid pada kolom di bawah.</label><br>
            <input type="hidden" value="<?php echo $this->session->userdata('id'); ?>" name="id_bid">
            <input type="hidden" value="<?php echo $auction_detail->id_auction; ?>" name="id_auction">
            <input type="hidden" value="<?php echo $auction_detail->bid_interval; ?>" name="bid_interval">
            <input type="hidden" value="<?php echo $auction_detail->lower_limit; ?>" name="lower_limit">
            <input type="hidden" value="<?php echo $auction_detail->start_price; ?>" name="start_price">
            <input type="hidden" value="<?php echo $this->uri->uri_string(); ?>" name="current_uri">
            <input type="text" placeholder="Bid dalam Rp" name="bid" class="input-text fullwidth">
            <button class="button coupon " type="submit"><span>Place bid</span></button>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal cocok -->
<div class="modal fade" id="myModal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cocok Dengan Harga</h4>
      </div>
      <?php echo form_open('auctions/set_bid'); ?>
      <div class="modal-body">
        <span>Dengan menekan <strong>Cocok dengan harga</strong>, kamu akan memberikan 
        notifikasi pada penjual kalau kamu sudah deal dengan harga dan menempatkan bid tertinggi di lapak ini.</span><br>
        <div class="bid-form">
            <label for="coupon_code">Dengan kata lain, bidmu adalah sebesar harga awal, yaitu : </label><br>
            <input type="hidden" value="<?php echo $this->session->userdata('id'); ?>" name="id_bid">
            <input type="hidden" value="<?php echo $auction_detail->id_auction; ?>" name="id_auction">
            <input type="hidden" value="<?php echo $auction_detail->bid_interval; ?>" name="bid_interval">
            <input type="hidden" value="<?php echo $auction_detail->start_price; ?>" name="start_price">
            <input type="hidden" value="<?php echo $this->uri->uri_string(); ?>" name="current_uri">
            <input type="hidden" value="<?php echo $auction_detail->start_price; ?>" name="bid"></input>
            <input disabled=""  type="text" placeholder="Rp <?php echo number_format($auction_detail->start_price); ?>" class="input-text fullwidth">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Iya</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Modal tutup -->
<div class="modal fade" id="myModal-3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tutup Auction</h4>
      </div>
      <?php echo form_open('auctions/close'); ?>
      <div class="modal-body">
        <span>Kamu akan <strong>menutup lapak ini</strong> atau <strong>menandainya sudah laku</strong>.</span><br>
        <div class="bid-form">
            <input type="hidden" value="<?php echo $auction_detail->id_auction; ?>" name="id_auction">
            <input type="hidden" value="<?php echo $this->uri->uri_string(); ?>" name="current_uri">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Iya</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Modal review -->
<div class="modal fade" id="myModal-4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Review</h4>
      </div>
      <?php echo form_open('members/set_review'); ?>
      <div class="modal-body">
        <span>Kamu akan <strong>memberikan review</strong> untuk <strong><a href="<?php echo base_url().'members/detail/'.$auction_winner->username; ?>"><?php echo $auction_winner->fullname.' ('.$auction_winner->username.')'; ?></a></strong> sebagai pemenang bid pada lapak ini.</span><br>
        <div class="bid-form">
            <input type="hidden" value="<?php echo $auction_detail->id_auction; ?>" name="id_auction">
            <input type="hidden" value="<?php echo $this->uri->uri_string(); ?>" name="current_uri">
            <input type="hidden" value="<?php echo $auction_winner->id_bidder; ?>" name="id_receiver"></input>
        </div>
        <div class="row">
          <div class="col-md-4">
            <label>Subject</label><br>
            <input type="text" placeholder="Review subject" name="review_subject" class="input-text fullwidth"><br><br>
            <label>Your rate</label>
            <input value="1" name="review_type" checked data-toggle="toggle" data-width="80" data-style="android" data-on="Nice" data-off="Bad" data-onstyle="success" data-offstyle="danger" type="checkbox">
          </div>
          <div class="col-md-8">
            <label>Your review</label>
            <textarea name="review_content" placeholder="Write reviews here..." style="width: 100%;" rows="5"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="button submit" title="Submit Review" type="submit"><span>Submit Review</span></button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Modal review penjual -->
<div class="modal fade" id="myModal-5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Review</h4>
      </div>
      <?php echo form_open('members/set_review'); ?>
      <div class="modal-body">
        <span>Kamu akan <strong>memberikan review</strong> untuk <strong><a href="<?php echo base_url().'members/detail/'.$auction_detail->username; ?>"><?php echo $auction_detail->fullname.' ('.$auction_detail->username.')'; ?></a></strong> sebagai pemilik lapak ini.</span><br>
        <div class="bid-form">
            <input type="hidden" value="<?php echo $auction_detail->id_auction; ?>" name="id_auction">
            <input type="hidden" value="<?php echo $this->uri->uri_string(); ?>" name="current_uri">
            <input type="hidden" value="<?php echo $auction_detail->id_auctioneer; ?>" name="id_receiver"></input>
        </div>
        <div class="row">
          <div class="col-md-4">
            <label>Subject</label><br>
            <input type="text" placeholder="Review subject" name="review_subject" class="input-text fullwidth"><br><br>
            <label>Your rate</label>
            <input value="1" name="review_type" checked data-toggle="toggle" data-width="80" data-style="android" data-on="Nice" data-off="Bad" data-onstyle="success" data-offstyle="danger" type="checkbox">
          </div>
          <div class="col-md-8">
            <label>Your review</label>
            <textarea name="review_content" placeholder="Write reviews here..." style="width: 100%;" rows="5"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="button submit" title="Submit Review" type="submit"><span>Submit Review</span></button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>