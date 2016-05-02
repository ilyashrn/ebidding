      <div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
          <aside class="col-left sidebar">
            <div class="side-nav-categories">
              <div class="block-title"> Categories </div>
              <!--block-title--> 
              <!-- BEGIN BOX-CATEGORY -->
              <div class="box-content box-category">
                <ul>
                  <?php foreach ($product_categories as $cat): ?>
                  <li> <a <?php echo ($this->uri->segment(3) == $cat->category_name) ? 'class="active"' : '' ;?> href="<?php echo base_url(),'auctions/category/'.$cat->category_name.'/all' ?>"><?php echo $cat->category_name ?></a> <span class="subDropdown <?php echo ($this->uri->segment(3) == $cat->category_name) ? 'minus' : 'plus'; ?>"></span>
                    <ul class="level0_415" style="<?php echo ($this->uri->segment(3) == $cat->category_name) ? 'display:block;' : 'display:none;' ; ?>">
                      <!--level1-->
                      <?php foreach ($this->categories_model->get_sub_per_category($cat->id_category) as $sub): ?>
                        <li> <a href="<?php echo base_url().'auctions/category/'.$cat->category_name.'/'.$sub->sub_name ?>"> <?php echo $sub->sub_name; ?> </a></span>
                        </li>
                        <!--level1-->
                      <?php endforeach ?>
                    </ul>
                    <!--level0--> 
                  </li>
                  <!--level 0-->
                  <?php endforeach ?>
                </ul>
              </div>
              <!--box-content box-category--> 
            </div>
            
            <div class="block block-layered-nav">
              <div class="block-title">Shop By</div>
              <div class="block-content">
                <p class="block-subtitle">Shopping Options</p>
                <dl id="narrow-by-list">
                  <dt class="odd">Price</dt>
                  <dd class="odd">
                    <ol>
                      <li> <a href="#"><span class="price">$0.00</span> - <span class="price">$99.99</span></a> (6) </li>
                      <li> <a href="#"><span class="price">$100.00</span> and above</a> (6) </li>
                    </ol>
                  </dd>
                  <dt class="even">Manufacturer</dt>
                  <dd class="even">
                    <ol>
                      <li> <a href="#">TheBrand</a> (9) </li>
                      <li> <a href="#">Company</a> (4) </li>
                      <li> <a href="#">LogoFashion</a> (1) </li>
                    </ol>
                  </dd>
                  <dt class="odd">Color</dt>
                  <dd class="odd">
                    <ol>
                      <li> <a href="#">Green</a> (1) </li>
                      <li> <a href="#">White</a> (5) </li>
                      <li> <a href="#">Black</a> (5) </li>
                      <li> <a href="#">Gray</a> (4) </li>
                      <li> <a href="#">Dark Gray</a> (3) </li>
                      <li> <a href="#">Blue</a> (1) </li>
                    </ol>
                  </dd>
                  <dt class="last even">Size</dt>
                  <dd class="last even">
                    <ol>
                      <li> <a href="#">S</a> (6) </li>
                      <li> <a href="#">M</a> (6) </li>
                      <li> <a href="#">L</a> (4) </li>
                      <li> <a href="#">XL</a> (4) </li>
                    </ol>
                  </dd>
                </dl>
              </div>
            </div>
            <div class="custom-slider">
              <div>
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li class="active" data-target="#carousel-example-generic" data-slide-to="0"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="item active"><img src="<?php echo base_url().'assets/aspire/';?>images/slide3.jpg" alt="slide3">
                      <div class="carousel-caption">
                        <h3><a title=" Sample Product" href="#">50% OFF</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <a class="link" href="#">Buy Now</a></div>
                    </div>
                    <div class="item"><img src="<?php echo base_url().'assets/aspire/';?>images/slide1.jpg" alt="slide1">
                      <div class="carousel-caption">
                        <h3><a title=" Sample Product" href="#">Hot collection</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                      </div>
                    </div>
                    <div class="item"><img src="<?php echo base_url().'assets/aspire/';?>images/slide2.jpg" alt="slide2">
                      <div class="carousel-caption">
                        <h3><a title=" Sample Product" href="#">Summer collection</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                      </div>
                    </div>
                  </div>
                  <a class="left carousel-control" href="#" data-slide="prev"> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#" data-slide="next"> <span class="sr-only">Next</span> </a></div>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>
  <!-- Main Container End --> 