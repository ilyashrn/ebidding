<!-- main-container -->
  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <section class="col-sm-9 wow bounceInUp animated">
        <div class="col-main">
          <div class="my-account">
            <div class="page-title">
              <h2><?php echo $subtitle; ?></h2>
            </div>
          </div>
          <div class="bid-in">
            <div class="box visible">
              <?php if ($reviews): ?>
                <?php foreach ($reviews as $rev): ?>
                  <div class="review">
                    <h6><a href="#"><?php echo $rev->review_subject ?></a></h6>
                    <small>Review <?php echo ($rev->review_type) ? 'positif':'negatif' ; ?> oleh <span><a href="<?php echo base_url().'members/detail/'.$rev->username; ?>"><?php echo $rev->fullname ?></a></span> untuk <strong><?php echo $rev->name; ?></strong> </small><br>
                    <small>pada <?php echo $rev->review_timestamp ?></small>
                    <div class="review-txt"> <?php echo $rev->review_content; ?></div>
                  </div>
                <?php endforeach ?>
              <?php else: ?>
                <div class="alert alert-warning">Tidak ada review untuk member ini.</div>
              <?php endif ?>
            </div>  
          </div>
          </div>
        </section>