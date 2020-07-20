<div class="site-blocks-cover overlay" style="background-image: url(<?php echo $this->ps_image->upload_url .'/eads/hero_2.jpg'; ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">

      <div class="col-md-12">
        
        
        <div class="row justify-content-center mb-4">
          <div class="col-md-8 text-center">
            <h1 class="" data-aos="fade-up">Largest Classifieds In The World</h1>
            <p data-aos="fade-up" data-aos-delay="100">You can buy, sell anything you want.</p>
          </div>
        </div>

        <div class="form-search-wrap" data-aos="fade-up" data-aos-delay="200">
          <?php
            $attributes = array( 'id' => 'search-form', 'enctype' => 'multipart/form-data');
            echo form_open( site_url('search'), $attributes);
          ?>
            <div class="row align-items-center">
              <div class="col-lg-12 mb-4 mb-xl-0 col-xl-4">
                <input type="text" name="title" id="title" value="<?php echo $item_title; ?>" class="form-control rounded" placeholder="What are you looking for?">
              </div>
              <div class="col-lg-12 mb-4 mb-xl-0 col-xl-3">
                  <div class="select-wrap">
                  <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
                  <select class="form-control rounded" name="item_location_id" id="item_location_id">
                    <option value="0">Load all locations</option>
                    <?php
                      $locations = $this->Itemlocation->get_all( )->result();
                      foreach($locations as $loc) {
                        if ($loc->id == $item_location_id) {
                          echo '<option value="'.$loc->id.'" selected>'.$loc->name.'</option>'; 
                        } else {
                          echo '<option value="'.$loc->id.'">'.$loc->name.'</option>'; 
                        }      
                      }
                    ?>
                    
                  </select>
                </div>
              </div>
             
              <div class="col-lg-12 mb-4 mb-xl-0 col-xl-3">
                <div class="select-wrap">
                  <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
                  <select class="form-control rounded" name="cat_id" id="cat_id">
                    <option value="0">Load all categories</option>
                    <?php
                      $categories = $this->Category->get_all( )->result();
                      foreach($categories as $cat) {

                        if ($cat->cat_id == $cat_id) {
                            echo '<option value="'.$cat->cat_id.'" selected>'.$cat->cat_name.'</option>';   
                        } else {
                          echo '<option value="'.$cat->cat_id.'">'.$cat->cat_name.'</option>'; 
                        }      
                      }
                    ?>
                    
                  </select>
                </div>
              </div>
              <div class="col-lg-12 col-xl-2 ml-auto text-right">
                <input type="submit" name="submit" class="btn btn-primary btn-block rounded" value="Search">
              </div>
              
            </div>
          <?php echo form_close(); ?>
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

            <div style="text-align: center; font-size: 36px;">
              <?php if( $current!=1 ) { ?>
                <a href="<?php echo site_url('/search/'.($current-1)) ?>">

                  <span class="fa fa-caret-left" style="color: red;font-size: 50px;margin-top: -5px;"></span>
                  
                </a>
              <?php } ?> 
              <?php if( $noofpage > $current ) { ?>
                <a href="<?php echo site_url('/search/'.($current+1)) ?>">
                  
                  <span class="fa fa-caret-right" style="color: red;font-size: 50px;margin-top: -5px;"></span>

                </a>
              <?php } ?>
            </div>
            <!-- <div class="col-12 mt-5 text-center">
              <div class="custom-pagination">
                <?php if( $pageno==1 || $pageno!=0 ) { ?>
                  <a href="#">1</a>
                <?php } ?> 

                <?php if( $pageno < $total_pages ) { ?>
                  <a href="<?php echo site_url('/search/'.($pageno+1)) ?>"><?php echo $pageno+1; ?></a>
                <?php } ?>

                <?php if( $pageno == $total_pages ) { ?>
                  <a href="#"><?php echo $pageno; ?></a>
                <?php } ?>
              </div>
            </div> -->

          </div>
        </div>
      </div>
    </div>