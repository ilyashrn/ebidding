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
              <?php 
              $attr = array('class' => 'filter-form');
              echo form_open('auctions/search',$attr); ?>
              <div class="block-title">Filter</div>
              <div class="block-content">
                <p class="block-subtitle"></p>
                <dl id="narrow-by-list">
                  <dt class="odd">Kata kunci</dt>
                  <dd class="odd">
                    <input type="text" class="input-text" name="search" placeholder="Kata kunci" value="<?php echo $this->session->userdata('keyword'); ?>"> 
                  </dd>
                  <dt class="odd">Range harga</dt>
                  <dd class="odd">
                    <input type="number" class="input-text" name="price_from" placeholder="From (Rp)" value="<?php echo $this->session->userdata('price_from'); ?>"> 
                    <input type="number" class="input-text" name="price_to" placeholder="To (Rp)" value="<?php echo $this->session->userdata('price_to'); ?>">
                  </dd>
                  <dt class="even">Kondisi</dt>
                  <dd class="even">
                    <input type="checkbox" name="Baru" value="1" <?php echo ($this->session->userdata('Baru')) ? 'checked': '' ;?>> Baru
                    <input type="checkbox" name="Bekas" value="1" <?php echo ($this->session->userdata('Bekas')) ? 'checked': '' ;?>> Bekas
                  </dd>
                  <dt class="odd">Status</dt>
                  <dd class="odd">
                    <input type="checkbox" name="not_closed" value="1" <?php echo ($this->session->userdata('not_closed')) ? 'checked': '' ;?>> Dijual
                    <input type="checkbox" name="closed" value="1" <?php echo ($this->session->userdata('closed') == 1) ? 'checked': '' ;?>> Sudah laku/ditutup
                  </dd>
                  <input type="hidden" name="refine" value="1">
                </dl>
                <button class="button coupon" type="submit">Filter</button>
              </div>
              <?php echo form_close(); ?>
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
                    <div class="item active"><img src="<?php echo base_url().'assets/aspire/';?>images/adv2.jpg" alt="slide3">
                      <div class="carousel-caption">
                        <h3><a title=" Sample Product" href="#">Adv Sample</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <!-- <a class="link" href="#">Buy Now</a> -->
                        </div>
                    </div>
                    <div class="item"><img src="<?php echo base_url().'assets/aspire/';?>images/adv2.jpg" alt="slide1">
                      <div class="carousel-caption">
                        <h3><a title=" Sample Product" href="#">Adv sample 2</a></h3>
                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
                      </div>
                    </div>
                    <!-- <div class="item"><img src="<?php echo base_url().'assets/aspire/';?>images/slide2.jpg" alt="slide2">
                      <div class="carousel-caption">
                        <h3><a title=" Sample Product" href="#">Summer collection</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                      </div>
                    </div> -->
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