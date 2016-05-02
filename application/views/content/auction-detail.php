<script type="text/javascript">
$(document).ready(function() {
  $("select").select2();
});
</script>

<!-- Breadcrumbs -->
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a href="<?php echo base_url().'auctions'?>">Auctions</a> <span>/</span> </li>
            <li class="category1599"> <a href=""><?php echo $auction_detail->category_name; ?></a> <span>/ </span> </li>
            <li class="category1600"> <a href="" title=""><?php echo $auction_detail->sub_name ?></a> </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumbs End --> 
  
    <!-- Main Container -->
  <section class="main-container col1-layout">
    <div class="main">
      <div class="container">
        <div class="row">
          <div class="col-main">
            <div class="product-view">
              <div class="product-essential">
                  <div class="product-img-box col-lg-4 col-sm-5 col-xs-12">
                    <div class="product-image">
                    <?php
                    $img_thumbnail = $this->products_picts_model->get_product_thumbnail($auction_detail->id_product);
                    ?>
                      <div class="product-full"> <img id="product-zoom" src="<?php echo base_url().'assets/img/posts/'.$img_thumbnail->img_file;?>" data-zoom-image="<?php echo base_url().'assets/img/posts/'.$img_thumbnail->img_file;?>" alt="product-image"/> </div>
                      <div class="more-views">
                        <div class="slider-items-products">
                          <div id="gallery_01" class="product-flexslider hidden-buttons product-img-thumb">
                            <div class="slider-items slider-width-col4 block-content">
                              <?php foreach ($product_picts as $pict) { ?>
                                <div class="more-views-items"> <a href="#" data-image="<?php echo base_url().'assets/img/posts/'.$pict->img_file;?>" data-zoom-image="<?php echo base_url().'assets/img/posts/'.$pict->img_file;?>"> <img id="product-zoom"  src="<?php echo base_url().'assets/img/posts/'.$pict->img_file;?>" alt="product-image"/> </a></div>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end: more-images --> 
                  </div>
                  <div class="product-shop col-lg-8 col-sm-7 col-xs-12">
                    <?php if ($this->session->flashdata('warn')): ?>
                      <div class="alert alert-danger"><?php echo $this->session->flashdata('warn'); ?></div>
                    <?php endif ?>
                    <?php if ($this->session->flashdata('msg')): ?>
                      <div class="alert alert-success"><?php echo $this->session->flashdata('msg'); ?></div>
                    <?php endif ?>
                    <div class="product-name">
                      <h1><?php echo $auction_detail->name; ?></h1>
                    </div>
                    <div class="ratings">
                      <p class="rating-links"> <strong>Current : <?php echo $bids_count ?> bid(s)</strong><span class="seperator">| </span><a href="">1 views</a></p>
                    </div>
                    <div class="price-block">
                      <div class="price-box">
                        <p class="special-price"> <span class="price-label">Special Price</span> <span id="product-price-48" class="price"> Rp <?php echo number_format($auction_detail->start_price) ;?> </span> </p>
                        <p class="old-price"> <span class="price-label">Regular Price:</span> </p>
                        <?php if ($auction_detail->is_clossed == 1) { ?>
                          <p class="availability out-of-stock pull-right"><span>sold out</span></p>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="short-description">
                      <h2>Deskripsi barang</h2>
                      <p><?php echo $auction_detail->description; ?></p>
                    </div>
                    <?php if ($auction_detail->id_auctioneer !== $this->session->userdata('id')): ?>
                      <?php if ($this->session->userdata('id')!== $auction_winner->id_bidder ): ?>
                        <div class="add-to-box">
                          <div class="add-to-cart">
                            <button data-toggle="modal" data-target="#myModal-2" class="button btn-cart" type="button">Cocok dengan harga</button>
                            <button id="bid-now" data-toggle="modal" data-target="#myModal" class="button btn-cart" type="button">Bid sekarang</button>
                          </div>
                        </div>
                      <?php else: ?>
                        <div class="add-to-box">
                          <div class="add-to-cart">
                            <button type="button" data-toggle="collapse" data-target="#kontak" class="button btn-cart" type="button">Kontak penjual</button>
                            <button data-toggle="modal" data-target="#myModal-5" class="button btn-cart" type="button">Review untuk penjual</button>
                          </div>
                        </div>
                        <div class="collapse" id="kontak" style="width: 70%;">
                              <div class="well">
                                <h3 style="margin-top: 0;"><?php echo $auction_detail->fullname; ?></h3>
                                <strong>Alamat lengkap : </strong><?php echo $auction_detail->address; ?><br>
                                <strong>Kota, provinsi : </strong><?php echo $auction_detail->city.', '.$auction_detail->province ?><br>
                                <strong>No. handphone : </strong><?php echo $auction_detail->phone_number; ?>
                              </div>
                            </div>
                      <?php endif ?>
                    <?php else: ?>
                    <div class="add-to-box">
                      <div class="add-to-cart">
                        <button data-toggle="modal" data-target="#myModal-3" class="button btn-cart" type="button">Tandai sudah laku / tutup auction</button>
                        <?php if (!$this->reviews_model->check_entry($auction_detail->id_auction,$this->session->userdata('id'),$auction_winner->id_bidder)): ?>
                          <button data-toggle="modal" data-target="#myModal-4" class="button btn-cart" type="button">Review untuk pembeli</button>
                        <?php endif ?>
                      </div>
                    </div>
                    <?php endif ?>
                    <div class="social">
                      <span class="product-date">Update pada <?php echo $auction_detail->start_timestamp; ?> oleh <a href="<?php echo base_url().'members/detail/'.$auction_detail->username; ?>"><?php echo $auction_detail->username; ?></a></span>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="product-collateral col-lg-12 col-sm-12 col-xs-12">
            <div class="add_info">
              <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                <li class="active"> <a href="#product_tabs_description" data-toggle="tab"> Bid(s) saat ini </a> </li>
                <li> <a href="#reviews_tabs" data-toggle="tab">Review pengguna ini</a> </li>
              </ul>
              <div id="productTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="product_tabs_description">
                  <div class="std">
                    <div class="row">
                      <h3>Bid summary</h3>
                      <div class="inner">
                        <table class="table shopping-cart-table-total" id="shopping-cart-totals-table" width="80%;">
                          <colgroup>
                          <col>
                          <col width="1">
                          </colgroup>
                          <thead>
                              <td colspan="1" style="" width="20%"><strong>Bidder</strong></td>
                              <td colspan="1" style="" width="30%"><strong><span class="price">Bid</span></strong></td>
                              <td colspan="1" width="30%"><strong>Timestamp</strong></td>
                              <td width="20%"></td>
                          </thead>
                          <tfoot>
                            <tr>
                              <td colspan="1" style=""><strong>Start price</strong></td>
                              <td style=""><strong><span class="price">Rp <?php echo number_format($auction_detail->start_price) ;?></span></strong></td>
                              <td></td>
                              <td></td>
                            </tr>
                          </tfoot>
                          <tbody>
                            <?php if ($bid_list): ?>
                              <?php foreach ($bid_list as $bid): ?>
                                <tr id="bid-<?php echo $bid->id_bid?>">
                                  <td <?php echo ($bid->id_bidder == $this->session->userdata('id')) ? 'style="background-color: #ffd740"' : '' ;?> colspan="1" style="">
                                    <a href="<?php echo base_url().'members/detail/' ?>"><?php echo $bid->username; ?></a>
                                    </td>
                                  <td colspan="1" style="">
                                    <strong><span class="price">Rp <?php echo number_format($bid->bid_value) ;?></span></strong>
                                    <?php if ($auction_detail->id_winner == $bid->id_bid): ?>
                                      <div class="label label-warning">Winner</div>
                                    <?php endif ?>
                                  </td>
                                  <td colspan="1"><?php echo $bid->bid_timestamp ?></td>
                                  <td>
                                    <?php if ($this->session->userdata('id') == $auction_detail->id_auctioneer): ?>
                                      <strong><a role="button" data-toggle="collapse" href="#collapse-detail-<?php echo $bid->id_bid;?>">See detail</a></strong>
                                    <?php endif ?>
                                    <?php if ($this->session->userdata('id') == $bid->id_bidder): ?>
                                      <?php 
                                        $batalkan = 'batalkan-'.$bid->id_bid;
                                      $attributes = array('id' => $batalkan); echo form_open('auctions/unset_bid',$attributes); ?>
                                      <input type="hidden" name="id_auction" value="<?php echo $auction_detail->id_auction ?>"></input>
                                      <input type="hidden" name="id_winner" value="<?php echo $auction_detail->id_winner ?>"></input>
                                      <input type="hidden" name="id_bid" value="<?php echo $bid->id_bid ?>"></input>
                                      <input type="hidden" name="current_uri" value="<?php echo $this->uri->uri_string() ?>"></input>
                                      <strong><a role="button" onclick="document.getElementById('<?php echo $batalkan ?>').submit();" class="cancel-bid" href="#">Batalkan bid</a></strong>
                                      <?php echo form_close(); ?>
                                    <?php endif ?>
                                  </td>
                                  </td>
                                  <div class="collapse" id="collapse-detail-<?php echo $bid->id_bid;?>" style="width: 70%;">
                                    <div class="well">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <h4>Activity Detail - <?php echo $bid->fullname; ?></h4>
                                        </div>
                                        <div class="col-md-6">
                                          <span>Bidder : <strong><a href=""><?php echo $bid->fullname; ?> (<?php echo $bid->username; ?>)</a></strong></span><br>
                                          <span>Location : <?php echo ($bid->city) ? $bid->city.', '.$bid->province : '-';?></span><br>
                                          <span>Bid : Rp <?php echo number_format($bid->bid_value) ?></span><br>
                                          <span>Timestamp : <?php echo $bid->bid_timestamp; ?></span><br>
                                        </div>
                                        <div class="col-md-6">
                                          <span>Review positif : 5 (50%)</span><br>
                                          <span>Review negatif : 4 (40%)</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </tr>
                              <?php endforeach ?>
                            <?php endif ?>
                          </tbody>
                        </table>
                        <?php if ($auction_detail->id_auctioneer == $this->session->userdata('id')): ?>
                        <ul class="checkout">
                          <li>
                          <?php if ($auction_detail->id_winner): ?>
                            <button data-toggle="collapse" data-target="#collapse-reset" class="button btn-proceed-checkout" title="Proceed to Checkout" type="button"><span>Reset winner</span></button>
                          <?php else: ?>
                            <button data-toggle="collapse" data-target="#collapse-winner" class="button btn-proceed-checkout" title="Proceed to Checkout" type="button"><span>Set a winner</span></button>
                          <?php endif ?>
                          </li>
                        </ul>
                        <br>
                        <div class="collapse" id="collapse-reset">
                          <div class="well">
                            <div class="row">
                              <div class="col-md-8">
                                <h2>Pemenang bid</h2>
                                <div class="alert alert-info">Dengan menetapkan seorang bidder menjadi pemenang : 
                                <ul>
                                  <li>Informasi kontakmu akan dikirimkan kepada bidder guna melakukan transaksi.</li>
                                  <li>Pembeli dan penjual dapat saling memberi review atas transaksi, baik yang terjadi maupun tidak.</li>
                                  <li>Dapat menetapkan bidder lain sebagai pemenang dan menggugurkan pemenang lama.</li>
                                </ul></div>
                                <?php echo form_open('auctions/set_winner'); ?>
                                  <input type="hidden" name="id_auction" value="<?php echo $auction_detail->id_auction ?>"></input>
                                  <input type="hidden" name="id_auctioneer" value="<?php echo $auction_detail->id_auctioneer ?>"></input>
                                  <input type="hidden" name="current_uri" value="<?php echo $this->uri->uri_string() ?>"></input>
                                  <select name="winner" style="width: 50%">
                                      <option>Pilih bidder pemenang</option>
                                    <?php foreach ($bid_list as $bid): ?>
                                      <option value="<?php echo $bid->id_bid ?>">Rp <?php echo number_format($bid->bid_value).' - '.$bid->username.' ('.$bid->fullname.')' ?></option>
                                    <?php endforeach ?>
                                  </select>
                                  <button class="button coupon" type="submit"><span>Assign as new winner</span></button>
                                <!-- <?php echo form_close(); ?> -->
                                <!-- <?php echo form_open(); ?> -->
                                  <a href="<?php echo base_url().'auctions/reset_winner/'.$auction_detail->id_auction.'/'.$auction_detail->id_product.'/'.$auction_detail->id_auctioneer ?>" class="button coupon" style="background-color: #d14233;border-color: #d14233;text-transform: uppercase;font-size: 11px;font-weight: bold;"><span>reset current winner</span></a>
                                <?php echo form_close(); ?>
                                  <!-- <input type="hidden" name="id_auction" value="<?php echo $auction_detail->id_auction ?>"></input>
                                  <input type="hidden" name="current_uri" value="<?php echo $this->uri->uri_string() ?>"></input>
                                  <input type="hidden" name="current_winner" value="<?php echo $auction_detail->id_winner ?>"></input> -->
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="collapse" id="collapse-winner">
                          <div class="well">
                            <div class="row">
                              <div class="col-md-8">
                                <h2>Pemenang bid</h2>
                                <div class="alert alert-info">Dengan menetapkan seorang bidder menjadi pemenang : 
                                <ul>
                                  <li>Informasi kontakmu akan dikirimkan kepada bidder guna melakukan transaksi.</li>
                                  <li>Pembeli dan penjual dapat saling memberi review atas transaksi, baik yang terjadi maupun tidak.</li>
                                  <li>Dapat menetapkan bidder lain sebagai pemenang dan menggugurkan pemenang lama.</li>
                                </ul></div>
                                <?php echo form_open('auctions/set_winner'); ?>
                                  <input type="hidden" name="id_auction" value="<?php echo $auction_detail->id_auction ?>"></input>
                                  <input type="hidden" name="id_auctioneer" value="<?php echo $auction_detail->id_auctioneer ?>"></input>
                                  <input type="hidden" name="current_uri" value="<?php echo $this->uri->uri_string() ?>"></input>
                                  <select name="winner" style="width: 50%">
                                      <option>Pilih bidder pemenang</option>
                                    <?php foreach ($bid_list as $bid): ?>
                                      <option value="<?php echo $bid->id_bid ?>">Rp <?php echo number_format($bid->bid_value).' - '.$bid->username.' ('.$bid->fullname.')' ?></option>
                                    <?php endforeach ?>
                                  </select>
                                  <button class="button coupon " type="submit"><span>Assign as winner</span></button>
                                <?php echo form_close(); ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php endif ?>
                      </div>
                      <!--inner--> 
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="reviews_tabs">
                  <div class="box-collateral box-reviews" >
                    <div class="box-reviews2">
                      <h3>Reviews</h3>
                      <div class="box visible">
                        <?php if ($reviews): ?>
                          <?php foreach ($reviews as $rev): ?>
                            <div class="review">
                              <h6><a href="#"><?php echo $rev->review_subject ?></a></h6>
                              <small>Review <?php echo ($rev->review_type) ? 'positif':'negatif' ; ?> by <span><?php echo $rev->fullname ?> </span>on <?php echo $rev->review_timestamp ?> </small>
                              <div class="review-txt"> <?php echo $rev->review_content; ?></div>
                            </div>
                          <?php endforeach ?>
                        <?php else: ?>
                          <div class="alert alert-warning">Tidak ada review untuk user ini.</div>
                        <?php endif ?>
                      </div>
                      <!-- <div class="actions"> <a class="button view-all" id="revies-button" href="#"><span><span>View all</span></span></a> </div> -->
                    </div>
                    <div class="clear"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Main Container End --> 