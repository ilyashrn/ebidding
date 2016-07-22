<aside class="col-right sidebar col-sm-3 wow bounceInUp animated">
          <?php if ($this->uri->segment(2) !== 'detail' && $this->uri->segment(2) !== 'edit_profile') { ?>
          <div class="block block-compare">
            <div class="block-content">
              <img style="width: auto;height: auto;max-width: 100%;vertical-align: middle;" src="<?php echo ($mem_detail->avatar!=='') ? base_url().'assets/img/avatar/'.$mem_detail->avatar : base_url().'assets/img/avatar/default_avatar.png';?>">
              <h4><?php echo $mem_detail->fullname ?></h4>
              <span><i class="fa fa-location-arrow"></i> Malang, Jawa Timur</span><br>
              <span>Bergabung pada <?php echo $mem_detail->join_date; ?></span>
              <div class="ajax-checkout">
                <?php if ($mem_detail->id_member == $this->session->userdata('id')) {
                  echo form_open('members/edit_profile/'.$mem_detail->id_member.'/'.$mem_detail->username);
                 ?>
                <button type="submit" class="button button-clear"><span>edit</span></button>
                <?php
                echo form_close(); 
                } ?>
              </div>
            </div>
          </div>
          <?php } ?>
          <div class="block block-account">
            <div class="block-title">Account summary</div>
            <div class="block-content">
              <ul>
                <li <?php echo ($this->uri->segment(2) == 'active') ? 'class="current"' : '';?>><a href="<?php echo base_url().'auctions/active/'.$mem_detail->id_member.'/'.$mem_detail->username; ?>">Barang dijual (<?php echo $forsale_rec; ?>)</a></li>
                <li <?php echo ($this->uri->segment(2) == 'sold') ? 'class="current"' : '';?>><a href="<?php echo base_url().'auctions/sold/'.$mem_detail->id_member.'/'.$mem_detail->username; ?>">Barang terjual (<?php echo $sold_rec ?>)</a></li>
                <li <?php echo ($this->uri->segment(2) == 'incoming') ? 'class="current"' : '';?>><a href="<?php echo base_url().'bids/incoming/'.$mem_detail->id_member.'/'.$mem_detail->username; ?>">Bid masuk (<?php echo $bids_in ?>)</a></li>
                <li <?php echo ($this->uri->segment(2) == 'sent') ? 'class="current"' : '';?>><a href="<?php echo base_url().'bids/sent/'.$mem_detail->id_member.'/'.$mem_detail->username; ?>">Bid keluar (<?php echo $bids_out ?>)</a></li>
                <li class="<?php echo ($this->uri->segment(2) == 'reviews') ? 'current' : '';?>"><a href="<?php echo base_url().'members/reviews/'.$mem_detail->username; ?>">Review</a></li>
                <?php if ($this->session->userdata('id')==$mem_detail->id_member): ?>
                <li class="<?php echo ($this->uri->segment(2) == 'detail' || $this->uri->segment(2) == 'edit_profile') ? 'current' : '';?>"><a href="<?php echo base_url().'members/detail/'.$mem_detail->username; ?>">Informasi diri</a></li>
                <li class="last <?php echo ($this->uri->segment(1) == 'notifications') ? 'current' : '';?>"><a href="<?php echo base_url().'notifications/'.$mem_detail->username ?>">Notifikasi</a></li>
                <?php endif ?>
              </ul>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
  <!--End main-container -->