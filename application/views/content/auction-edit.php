<script type="text/javascript">
  // $("#input-id").fileinput();  
  $(document).on('ready', function() {
      $("#input-id").fileinput({
          browseClass: "btn btn-primary btn-block",
          showCaption: false,
          showRemove: false,
          showUpload: false
      });
  });

  $(document).ready(function() {
    $("select").select2();
  });
</script>
  <!-- main-container -->
  <?php
  $attributes = array('id' => "shipping-zip-form", 'style' => "width: 70%;");
  echo form_open_multipart('auctions/edit_process', $attributes); ?>
  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-sm-9 wow bounceInUp animated">
        <div class="col-main">
          <div class="page-title">
            <h1>Edit iklan</h1>
          </div>
          <ol class="one-page-checkout" id="checkoutSteps">
            <li id="opc-billing" class="section allow active">
              <div class="step-title"> <span class="number">1</span>
                <h3>Kategori barang</h3>
              </div>
              <div id="checkout-step-billing" class="step a-item" style="">
                <?php if ($this->session->flashdata('warn')) { ?>
                  <div class="alert alert-danger"><?php echo $this->session->flashdata('warn'); ?></div>
                <?php } ?>
                  <ul class="form-list">
                      <li style="margin-bottom: 10px;">
                        <label class="required" for="country">Kategori barang</label>
                        <div class="input-box">
                          <select class="js-example-basic-single" name="sub_category" style="width: 70%">
                            <option>Pilih kategori barang</option>
                            <?php foreach ($product_categories as $cat) { ?>
                              <optgroup label="<?php echo $cat->category_name;?>">
                              <?php 
                              foreach ($this->categories_model->get_sub_per_category($cat->id_category) as $sub) { ?>
                               <option <?php echo ($sub->id_subcategory == $auction_detail->id_cat) ? 'selected="selected"' : '' ;?> value="<?php echo $sub->id_subcategory;?>"><?php echo '<strong>'.$cat->category_name.'</strong> // '.$sub->sub_name;?></option>                 
                              <?php 
                              } 
                              ?>
                              </optgroup>
                            <?php } ?>
                          </select>
                        </div>
                      </li>
                    </ul>
              </div>
            </li>
            <li id="opc-shipping" class="section">
              <div class="step-title"> <span class="number">2</span>
                <h3 class="one_page_heading"> Informasi barang</h3>
              </div>
              <div id="checkout-step-shipping" class="step a-item">
                <div id="shipping-zip-form">
                  <ul class="form-list" style="width: 70%;">
                      <li style="margin-bottom: 10px;">
                        <label>Nama barang</label>
                        <div class="input-box">
                          <input placeholder="Nama produk atau barang untuk iklan" value="<?php echo $auction_detail->name; ?>" name="name" class="input-text validate-postcode" type="text" required>
                        </div>
                      </li>
                      <li style="margin-bottom: 10px;">
                        <label>Kondisi</label>
                        <div class="input-box">
                          <select name="condition" class="required-entry validate-select">
                            <option>Pilih kondisi barang</option>
                            <option <?php echo ($auction_detail->condition == "Baru") ? 'selected="selected"': ''; ?> value="Baru">Baru</option>
                            <option <?php echo ($auction_detail->condition == "Bekas") ? 'selected="selected"': ''; ?> value="Bekas">Bekas</option>
                          </select>
                        </div>
                      </li>
                      <li style="margin-bottom: 10px;">
                        <label>Foto barang</label>
                        <div class="input-box">
                          <div class="post-picts">
                            <?php foreach ($product_picts as $pict) { ?>
                              <div class="col-sm-4 post-pict">
                                <img style="width: 100%" src="<?php echo base_url().'assets/img/posts/'.$pict->img_file; ?>">
                                <a class="remove-a" href="<?php echo base_url().'auctions/remove_img/'.$pict->img_file.'/'.$pict->id_pict; ?>"><i class="fa fa-remove"></i> Remove photo</a>
                              </div>
                            <?php } ?>
                          </div>
                          <div class="form-group">
                            <input name="images[]" id="input-id" multiple type="file" class="file-loading">
                          </div>
                        </div>
                      </li>
                      <li style="margin-bottom: 10px;">
                        <label>Deskripsi</label>
                        <div class="input-box">
                          <textarea name="description" style="width: 90%;" rows="15" placeholder="Masukkan deskripsi mengenai barang disini"><?php echo $auction_detail->description ?></textarea>
                        </div>
                      </li>
                    </ul>
                  </div>
              </div>
            </li>
            <li id="opc-shipping" class="section">
              <div class="step-title"> <span class="number">3</span>
                <h3 class="one_page_heading"> Pengaturan auction</h3>
              </div>
              <div id="checkout-step-shipping" class="step a-item">
                <div id="shipping-zip-form">
                  <ul class="form-list" style="width: 70%;">
                      <li style="margin-bottom: 10px;">
                        <label>Harga dibuka</label>
                        <div class="input-box">
                          <input placeholder="Harga awal dalam Rp" value="<?php echo $auction_detail->start_price ?>" name="start_price" class="input-text validate-postcode" type="number" required>
                        </div>
                      </li>
                      <li style="margin-bottom: 10px;">
                        <label>Batas bawah bid</label>
                        <div class="input-box">
                          <input placeholder="Batas bawah penawaran yang diinginkan dalam Rp" name="lower_limit" value="<?php echo $auction_detail->lower_limit ?>" class="input-text validate-postcode" type="number" required>
                        </div>
                      </li>
                      <li style="margin-bottom: 10px;">
                        <label>Interval antar bid</label>
                        <div class="input-box">
                          <div class="form-group">
                            <input placeholder="Interval antar bid yang diinginkan dalam Rp" value="<?php echo $auction_detail->bid_interval ?>" name="bid_interval" class="input-text validate-postcode" type="number" required>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
              </div>
            </li>
            <input type="hidden" value="<?php echo $auction_detail->id_auction ?>" name="id_auction"></input>
            <input type="hidden" value="<?php echo $auction_detail->id_product ?>" name="id_product"></input>
            <button type="submit" name="sub_start" class="button coupon pull-right"><span>Simpan perubahan</span></button>
            <?php
            $this->session->set_flashdata('url', $this->uri->uri_string());
            echo form_close(); ?>
          </ol>
        </div>
      </section>
  </div>
  </div>
  </div>