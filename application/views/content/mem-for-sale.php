  <section class="main-container col2-left-layout bounceInUp animated">
    <div class="container">
      <div class="row">
        <div class="col-sm-9">
          <article class="col-main">
            <h2 class="page-heading"> <span class="page-heading-title"><?php echo $mem_detail->fullname.' ('.$mem_detail->username.')' ?> - Lapak <?php echo $subtitle ?></span> </h2>
            <?php if ($this->session->flashdata('msg')): ?>
              <div class="row">
                  <div class="col-md-4">
                    <div class="alert alert-success">
                      <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                  </div>
              </div>
            <?php endif ?>
            <div class="category-products">
              <ul class="products-grid">
              <?php if ($auctions): ?>
              <?php foreach ($auctions as $auc): ?>
                <li class="item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                  <div class="item-inner">
                    <div class="item-img">
                      <div class="item-img-info product-img-div">
                        <a href="<?php echo base_url().'auctions/detail/'.$auc->id_auction.'/'.$auc->id_product ?>" class="product-image">
                          <?php $thumbnail = $this->products_picts_model->get_product_thumbnail($auc->id_product);?>
                          <?php if ($thumbnail): ?>
                          <img src="<?php echo base_url().'assets/img/posts/'.$thumbnail->img_file ?>" alt="<?php echo $auc->name; ?>">
                        <?php else: ?>
                          <img src="<?php echo base_url().'assets/img/noimage.png'?>">
                          <?php endif ?>
                        </a>
                      </div>
                    </div>
                    <div class="item-info">
                      <div class="info-inner">
                        <div class="item-title"> 
                          <a href="<?php echo base_url().'auctions/detail/'.$auc->id_auction.'/'.$auc->id_product ?>"> <strong><?php echo $auc->name; ?></strong> </a> 
                        </div>
                        <div class="item-content">
                          <div class="rating">
                            <div class="ratings">
                              <span class="little-span"><i class="fa fa-level-down"></i> <?php echo $this->bids_model->get_per_auction_rows($auc->id_auction) ?> bids</span>
                              <span class="little-span"><i class="fa fa-eye"></i> <?php echo $auc->views_count ?> view(s)</span><br>
                              <span class="little-span"><i></i>Rp <?php echo number_format($auc->start_price) ?> | <?php echo $auc->start_timestamp ?></strong></span>
                            </div>
                          </div>
                          <div class="action action-grid">
                            <?php if ($auc->is_clossed == 0): ?>
                            <button class="product-button" onclick="location.href='../../edit/<?php echo $auc->id_auction.'/'.$auc->id_product.'/'.$auc->id_auctioneer; ?>'"><i class="fa fa-pencil"></i> <span>Edit iklan</span></button>
                            <!-- <button class="product-button" onclick="location.href='../../remove_with_product_process/<?php echo $auc->id_auction.'/'.$auc->id_product;?>'"><i class="fa fa-remove"></i> <span>Hapus iklan</span></button>  -->
                            <?php echo form_open('auctions/close'); ?>
                              <button class="product-button" type="submit"><i class="fa fa-check"></i> <span>Tandai lapak sudah laku</span></button> 
                              <input type="hidden" value="<?php echo $auc->id_auction; ?>" name="id_auction">
                              <input type="hidden" value="<?php echo $this->uri->uri_string(); ?>" name="current_uri">
                            <?php echo form_close(); ?>
                            <?php endif ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              <?php endforeach ?>
              </ul>
              <div class="toolbar">
                <div class="row">
                  <div class="col-lg-6 col-sm-7 col-md-5">
                    <div class="pager">
                      <div class="pages">
                        <label>Page:</label>
                        <ul class="pagination">
                          <li><a href="#">&laquo;</a></li>
                          <li class="active"><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">5</a></li>
                          <li><a href="#">&raquo;</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php else: ?>
                <div class="alert alert-info">Member ini tidak mempunyai auction pada kategori ini.</div>
              <?php endif ?>
            </div>
          </article>
          <!--  ///*///======    End article  ========= //*/// --> 
        </div>