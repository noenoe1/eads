<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo $this->ps_image->upload_url .'/eads/hero_1.jpg';?>);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center mt-5">
              <div class="col-md-8 text-center">
                <h1>Ads Listings</h1>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div> 

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">

            <div class="row">
              <?php $count = $this->uri->segment(4) or $count = 0; ?>
              <?php if ( !empty( $items ) && count( $items->result()) > 0 ): ?>
              <?php 
                  foreach($items->result() as $itm) {
                  $conds = array( 'img_type' => 'item', 'img_parent_id' => $itm->id );
                  $images = $this->Image->get_all_by( $conds )->result();
              ?>
              <div class="col-lg-4">
                
                <div class="d-block d-md-flex listing vertical">
                  <a href="#" class="img d-block" style="background-image: url(<?php echo $this->ps_image->upload_url .'/'. $images[0]->img_path;?>);"></a>
                  <div class="lh-content">
                    <span class="category"><?php echo $this->Category->get_one($itm->cat_id)->cat_name; ?></span>
                    <a href="#" class="bookmark"><span class="icon-heart"></span></a>
                    <h3><a href="#"><?php echo $itm->title; ?></a></h3>
                    <address><?php echo $itm->address; ?></address>
                    <p class="mb-0">
                      <span class="icon-star text-warning"></span>
                      <span class="icon-star text-warning"></span>
                      <span class="icon-star text-warning"></span>
                      <span class="icon-star text-warning"></span>
                      <span class="icon-star text-secondary"></span>
                      <span class="review">(3 Reviews)</span>
                    </p>
                  </div>
                </div>

              </div>
              <?php } ?>
              <?php endif ?> 
            </div>

            <div class="col-12 mt-5 text-center">
              <div class="custom-pagination">
                <?php if( $current!=1 ) { ?>
                  <a href="<?php echo site_url('/listing/'.$cat_id.'/'.($current-1)) ?>">2</a>
                <?php } ?> 

                <?php if( $noofpage > $current ) { ?>
                  <a href="<?php echo site_url('/listing/'.$cat_id.'/'.($current+1)) ?>">2</a>
                <?php } ?>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>