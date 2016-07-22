<!-- Footer -->
  <footer class="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <div class="social">
              <ul>
                <li class="fb"><a href="#"></a></li>
                <li class="tw"><a href="#"></a></li>
                <li class="googleplus"><a href="#"></a></li>
                <li class="rss"><a href="#"></a></li>
                <li class="pintrest"><a href="#"></a></li>
                <li class="linkedin"><a href="#"></a></li>
                <li class="youtube"><a href="#"></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-5 col-xs-12 coppyright"> &copy; 2016 E-Bidding. All Rights Reserved.</div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer --> 
</div>

<!-- mobile menu -->
<div id="mobile-menu">
  <ul>
    <li>
      <div class="mm-search">
        <form id="search1" name="search">
          <div class="input-group">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> </button>
            </div>
            <input type="text" class="form-control simple" placeholder="Search ..." name="srch-term" id="srch-term">
          </div>
        </form>
      </div>
    </li>
    <li><a href="<?php echo base_url() ?>">Home</a>
    </li>
    <?php foreach ($header_categories as $cat): ?>
      <li>
        <a href="<?php echo base_url().'auctions/category/'.$cat->category_name.'/all' ?>"><?php echo $cat->category_name ?></a>
        <ul>
        <?php if ($this->categories_model->get_sub_per_category($cat->id_category)): ?>
          <?php foreach ($this->categories_model->get_sub_per_category($cat->id_category) as $sub): ?>
            <li><a href="<?php echo base_url().'auctions/category/'.$cat->category_name.'/'.$sub->sub_name ?>"><?php echo $sub->sub_name ?></a></li>  
          <?php endforeach ?>
        <?php endif ?>
        </ul>
      </li>  
    <?php endforeach ?>
  </ul>
  <div class="top-links">
    <ul class="links">
    <?php if ($this->session->userdata('username')): ?>
      <li><a title="My Account" href="<?php echo base_url().'auctions/active/'.$this->session->userdata('id').'/'.$this->session->userdata('username'); ?>">My lapak</a> </li>
      <li><a title="Username" href="<?php echo base_url().'members/detail/'.$this->session->userdata('username'); ?>">Hi, <?php echo $this->session->userdata('username')?>!</a> </li>
      <li><a title="logout" href="<?php echo base_url().'main/logout' ?>"><span>Logout</span></a> </li>
    <?php else: ?>
      <li class="last"><a title="Login" href="<?php echo base_url().'main/login' ?>"><span>Login</span></a> </li>
    <?php endif ?>  
    </ul>
  </div>
</div>

<script src="<?php echo base_url()?>assets/aspire/js/owl.carousel.min.js"></script> 
<script src="<?php echo base_url()?>assets/aspire/js/cloud-zoom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
</body>
</html>