<!-- Breadcrumbs -->
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a href="index-2.html" title="Go to Home Page">Home</a> <span>/</span> </li>
            <li class="category1599"> <a href="grid.html" title="">Auctions</a> <span>/ </span> </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumbs End --> 

  <!-- Main Container -->
  <section class="main-container col2-left-layout bounceInUp animated">
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-sm-push-3">
          <article class="col-main">
            <h2 class="page-heading"> <span class="page-heading-title"><?php echo $subtitle ?></span> </h2>
            <?php if ($products): ?>
            <div class="category-products">
              <ul class="products-grid">
              <?php foreach ($products as $auc): ?>
                <li class="item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                    <div class="item-inner">
                      <div class="item-img">
                        <div class="item-img-info product-img-div">
                          <a href="<?php echo base_url().'auctions/detail/'.$auc->id_auction.'/'.$auc->id_product ?>" class="product-image">
                            <?php $thumbnail = $this->products_picts_model->get_product_thumbnail($auc->id_product); ?>
                            <img src="<?php echo base_url().'assets/img/posts/'.$thumbnail->img_file ?>" alt="<?php echo $auc->name; ?>">
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
                                <span class="little-span"><i class="fa fa-map-marker"></i> <?php echo $auc->city.', '.$auc->province ?></span>
                              </div>
                            </div>
                            <div class="item-price">
                              <div class="price-box">
                                <p class="special-price"><span style="color: red;" class="price">Rp <?php echo number_format($auc->start_price) ?> </span> </p>
                              </div>
                            </div>
                            <div class="action">
                              <button class="button btn-cart" type="button"><span>Bid sekarang</span></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                <?php endforeach ?>
                </ul>
            </div>
              <div class="toolbar">
                <div class="row">
                  <div class="col-lg-3 col-md-4">
                    <div id="sort-by">
                      <label class="left">Sort By: </label>
                      <ul>
                        <li><a href="#">Position<span class="right-arrow"></span></a>
                          <ul>
                            <li><a href="#">Name</a></li>
                            <li><a href="#">Price</a></li>
                            <li><a href="#">Position</a></li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-6 col-sm-7 col-md-5">
                    <div class="pager">
                      <div class="pages">
                        <!-- <label>Page:</label> -->
                          <?php echo $pagination_link; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php else: ?>
              <div class="col-md-12">
                <div class="alert alert-warning">Tidak ada barang pada kategori ini.</div>
              </div>
            <?php endif ?>
          </article>
          <!--	///*///======    End article  ========= //*/// --> 
        </div>