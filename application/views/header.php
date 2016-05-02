<div id="page"> 
  <!-- Header -->
  <header>
    <div class="header-container">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 logo-block"> 
            <!-- Header Logo -->
            <div class="logo"> <a title="Magento Commerce" href="<?php echo base_url() ?>"><img alt="Magento Commerce" src="<?php echo base_url().'assets/aspire/'?>images/logo.png"> </a> </div>
            <!-- End Header Logo --> 
          </div>
          <div class="col-lg-4 col-md-3 col-sm-4 col-xs-3 hidden-xs category-search-form">
            <div class="search-box">
              <?php echo form_open('auctions/search/');  ?>
                <!-- Autocomplete End code -->
                <input id="search" type="text" name="search" placeholder="Masukkan kata kuncimu disini..." class="searchbox" maxlength="128">
                <button type="submit" title="Search" class="search-btn-bg" id="submit-button"><span><i class="fa fa-search"></i></span></button>
              <?php echo form_close(); ?>
            </div>
          </div>

          <div class="col-xs-12 col-sm-6 col-md-7 col-lg-6 pull-right hidden-xs">
            <!-- Header Top Links -->
            <div class="toplinks">
              <div class="links">
                <?php if ($this->session->userdata('username')) { ?>
                  <div class="myaccount"><a href="<?php echo base_url().'auctions/active/'.$this->session->userdata('id').'/'.$this->session->userdata('username'); ?>"><span class="hidden-xs">My lapak</span></a> </div>
                  <div class="wishlist"><a href="<?php echo base_url().'members/detail/'.$this->session->userdata('username'); ?>"><span class="hidden-xs"> Hi, <?php echo $this->session->userdata('username')?>!</span></a> </div>
                  <div class="login"><a href="<?php echo base_url().'main/logout'?>"><span class="hidden-xs">Log out</span></a> </div>
                <?php } else { ?>
                  <div class="login"><a href="<?php echo base_url().'main/login'?>"><span class="hidden-xs">Log In</span></a> </div>
                <?php } ?>
              </div>
            </div>
            <!-- End Header Top Links --> 
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- end header -->
  <!-- nav --> 
  <nav>
    <div class="container">
      <div class="mm-toggle-wrap">
        <div class="mm-toggle"><i class="fa fa-align-justify"></i><span class="mm-label">Menu</span> </div>
      </div>
      <div class="nav-inner"> 
        <!-- BEGIN NAV -->
        <ul id="nav" class="hidden-xs">
          <li class="level0 parent drop-menu" id="nav-home"><a href="<?php echo base_url()?>" class="level-top active"><span>Home</span></a>
          </li>
          <li class="mega-menu"> <a class="level-top" href="<?php echo base_url().'auctions' ?>"><span>Categories</span></a>
            <div class="level0-wrapper dropdown-6col">
              <div class="container">
                <div class="level0-wrapper2">
                  <div class="nav-block nav-block-center"> 
                    <!--mega menu-->
                    <ul class="level0">
                      <?php foreach ($header_categories as $cat): ?>
                        <li class="level3 nav-6-1 parent item"> <a href=""><span><?php echo $cat->category_name; ?></span></a>
                        <ul class="level1">
                        <?php foreach ($this->categories_model->get_sub_per_category($cat->id_category) as $sub): ?>
                          <li class="level2 nav-6-1-1"> <a href=""><span><?php echo $sub->sub_name ?></span></a> </li>
                        <?php endforeach ?>
                        </ul>
                        </li>
                      <?php endforeach ?>
                    </ul>
                    <!--level0--> 
                  </div>
                  <!--nav-block nav-block-center--> 
                </div>
                <!--level0-wrapper2--> 
              </div>
              <!--container--> 
            </div>
            <!--level0-wrapper dropdown-6col--> 
            <!--mega menu--> 
          </li>
        </ul>
        <!--nav-->
        <?php if ($this->session->userdata('username')) { ?>
          <div class="top-cart-contain" style="margin-right: 15px;"> 
            <!-- Top Cart -->
            <div class="mini-cart-2">
              <div class="basket dropdown-toggle"> <a href="<?php echo base_url().'notifications/'.$this->session->userdata('username'); ?>"><span class="price">Notifications</span> <span class="cart_count"><?php echo $this->notifications_model->get_per_member_rows($this->session->userdata('id')) ?></span> </a> </div>
            </div>
          </div>
        <?php } ?>
        <div class="top-cart-contain" style="margin-right: 15px;margin-bottom: 10px;">
          <!-- Top Cart -->
          <div class="mini-cart-2">
            <div class="basket dropdown-toggle"> <a href="<?php echo base_url().'auctions/start_new' ?>"><span style="text-transform: uppercase;font-weight: bold;color: black;">Start Sell something</span> </a> </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <!-- end nav -->