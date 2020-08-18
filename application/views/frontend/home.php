<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



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
                <input type="text" name="title" id="title" class="form-control rounded" placeholder="What are you looking for?">
              </div>
              <div class="col-lg-12 mb-4 mb-xl-0 col-xl-3">
                  <div class="select-wrap">
                  <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
                  <select class="form-control rounded" name="item_location_id" id="item_location_id">
                    <option value="0">Load all locations</option>
                    <?php
                      $locations = $this->Itemlocation->get_all( )->result();
                      foreach($locations as $loc) {
                        echo '<option value="'.$loc->id.'">'.$loc->name.'</option>';       
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
                        echo '<option value="'.$cat->cat_id.'">'.$cat->cat_name.'</option>';       
                      }
                    ?>
                    
                  </select>
                </div>
              </div>
              <div class="col-lg-12 col-xl-2 ml-auto text-right">
                <input type="submit" value="submit" name="submit" class="btn btn-primary btn-block rounded" value="Search">
              </div>
              
            </div>
          <?php echo form_close(); ?>
        </div>

      </div>
    </div>
  </div>
</div>  



<div class="site-section bg-light">
  <div class="container">
    
    <div class="overlap-category mb-5">
      <div class="row align-items-stretch no-gutters">
        <?php
          $categories = $this->Category->get_all(6)->result();
          foreach ($categories as $cat) {
            $conds = array( 'img_type' => 'category-icon', 'img_parent_id' => $cat->cat_id );
            $images = $this->Image->get_all_by( $conds )->result();  
            $item_count = $this->Item->count_all_by(array('cat_id' => $cat->cat_id));
        ?>
        <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
          <a href="<?php echo site_url().'/listing/'.$cat->cat_id; ?>" class="popular-category h-100">
            <span class="icon"><img src="<?php echo $this->ps_image->upload_url . $images[0]->img_path; ?>" alt="" width="50"></span>
            <span class="caption mb-2 d-block"><?php echo $cat->cat_name;?></span>
            <span class="number"><?php echo $item_count; ?></span>
          </a>
        </div>
      <?php } ?>
     
      <div class="col-12 text-center mt-4">
        <a href="<?php echo site_url('categories'); ?>" class="btn btn-primary rounded py-2 px-4 text-white">View All Categories</a>
      </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-12">
        <h2 class="h5 mb-4 text-black">Sponsored Ads</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-12  block-13">
        <div class="owl-carousel nonloop-block-13">
          <?php
            $paiditems = $this->Paid_item->get_all()->result();
            foreach ($paiditems as $paid) {
              $conds = array( 'img_type' => 'item', 'img_parent_id' => $paid->item_id );
              $images = $this->Image->get_all_by( $conds )->result();
          ?>
          <div class="d-block d-md-flex listing vertical">
            <a href="<?php echo site_url().'/listing_single/'.$paid->item_id; ?>" class="img d-block" style="background-image: url(<?php echo $this->ps_image->upload_url .'/'.$images[0]->img_path; ?>);"></a>
            <div class="lh-content">
              <span class="category">
                <?php 
                  $cat_id = $this->Item->get_one($paid->item_id)->cat_id;
                  echo $this->Category->get_one($cat_id)->cat_name;
                ?>
              </span>
              <a href="#" class="bookmark"><span class="icon-heart"></span></a>
              <h3><a href="<?php echo site_url().'/listing_single/'.$paid->item_id; ?>"><?php echo $this->Item->get_one($paid->item_id)->title; ?></a></h3>
              <address><?php echo $this->Item->get_one($paid->item_id)->address; ?></address>
              
              <?php
                //Rating Calculation Here 
                
                $conds['to_user_id'] = $itm->added_user_id;
                
                //$ratings = $this->get_room_ratings( $room_id );
                $ratings = $this->Rate->get_all_by( $conds )->result();

                $rating_count_value = count($ratings); 
                $rating_total_value = 0;
                foreach ( $ratings as $rat ) {
                // loop each rating and get total
                  $rating_total_value += $rat->rating;
                }
                $final_rating =  $rating_total_value/$rating_count_value;

                ?>

                <p>
                  <?php

                  for($i=1; $i<=5;$i++) {
                    if($i < $final_rating) {
                      echo "<span class='fa fa-star checked'></span>";
                    } else {
                      echo "<span class='fa fa-star'></span>";
                    }

                  }

                  if($final_rating == 0) {
                      $rating_msg = "";
                  } else if($final_rating == 1) {
                      $rating_msg = " rating";
                  } else if($final_rating > 1) {
                      $rating_msg = " ratings";
                  }

                  echo "( " . floor($final_rating)  . $rating_msg . " )";
                  ?>

                  
                </p>


            </div>
          </div>
          <?php } ?>
        </div>
      </div>


    </div>
  </div>
</div>

<div class="site-section bg-light">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-7 text-left border-primary">
        <h2 class="font-weight-light text-primary">Trending Ads</h2>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-lg-12">
        <div class="row">
          
        
          <?php 

            $conds['order_by'] = 1;
            $conds['order_by_field']    = "touch_count";
            $conds['order_by_type']     = "desc";
            $items = $this->Item->get_all_by($conds,6)->result();
            foreach ($items as $itm) {
              $conds = array( 'img_type' => 'item', 'img_parent_id' => $itm->id );
              $images = $this->Image->get_all_by( $conds )->result();  
          ?>
          <div class="col-lg-6">
            <div class="d-block d-md-flex listing">
              <a href="<?php echo site_url().'/listing_single/'.$itm->id; ?>" class="img d-block" style="background-image: url(<?php echo $this->ps_image->upload_url .'/'.$images[0]->img_path; ?>);"></a>
              <div class="lh-content">
                <span class="category"><?php echo $this->Category->get_one($itm->cat_id)->cat_name; ?></span>
                <a href="#" class="bookmark"><span class="icon-heart"></span></a>
                <h3><a href="<?php echo site_url().'/listing_single/'.$paid->item_id; ?>"><?php echo $itm->title; ?></a></h3>
                <address><?php echo $itm->address; ?></address>
                
                <?php
                //Rating Calculation Here 
                
                $conds['to_user_id'] = $itm->added_user_id;
                
                //$ratings = $this->get_room_ratings( $room_id );
                $ratings = $this->Rate->get_all_by( $conds )->result();

                $rating_count_value = count($ratings); 
                $rating_total_value = 0;
                foreach ( $ratings as $rat ) {
                // loop each rating and get total
                  $rating_total_value += $rat->rating;
                }
                $final_rating =  $rating_total_value/$rating_count_value;



                ?>
                

                <p>
                  <?php

                  //$star_counter = $rating_count_value;

                  for($i=1; $i<=5;$i++) {
                    //echo $i ." - ". $final_rating;
                    if($i < $final_rating) {
                      echo "<span class='fa fa-star checked'></span>";
                    } else {
                      echo "<span class='fa fa-star'></span>";
                    }

                  }
                  ?>

                  
                </p>



              </div>
            </div>
          </div>
         <?php } ?>
         </div>
      </div>
    </div>
  </div>
</div>