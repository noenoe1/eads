<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo $this->ps_image->upload_url .'/eads/hero_1.jpg';?>);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center mt-5">
              <div class="col-md-8 text-center">
                <h1>Profile Information</h1>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div> 
    <div class="site-section bg-light">
      <div class="container" >
        <div class="row">
          <div class="col-lg-12">

            <div class="row">
              

            	 <div class="col-md-12 mb-5"  data-aos="fade">


	            	<form action="#" class="p-5 bg-white">
	             

		             
		             <?php 
		             	
		             	$user_profile_photo = $user_info->user_profile_photo;
		             ?>


		             <hr>
		             <div class="col-md-5"  data-aos="fade" data-aos-delay="100">
		             	


		             	<div class="table">
					  
						  <div class="tr">
						    <div class="td">
						    	<?php if($user_profile_photo!= '') { ?>
						    	<img width="300px" src=" <?php echo $this->ps_image->upload_url . $user_profile_photo; ?>">
						    	<?php } else { ?>
						    		<img width="300px" src=" <?php echo $this->ps_image->upload_url . 'no_image.png'; ?>" style="width: 50px;">
						    	<?php } ?>
						    </div>

						    <div class="td" style="padding-left: 100px;">
						    	Email : <br> <?php echo $user_info->user_email; ?> <br>
						    	Phone : <br> <?php echo $user_info->user_phone; ?> <br>


						    </div>
						    <div class="td" style="padding-left: 100px;">Address : <br> <?php echo $user_info->user_address; ?> </div>
						  </div>
						  
						</div>

		         	 </div>


	  
	            	</form>
          		</div>


            </div>

            

          </div>
        </div>


        <!-- Start user sponsored Items -->
        <?php
        	$conds['added_user_id'] = $user_info->user_id;

	        $paiditems = $this->Paid_item->get_all_by( $conds )->result();
	        if (count($paiditems) != '') {
        ?>
        <div class="row">
	      <div class="col-12">
	        <h2 class="h5 mb-4 text-black">My Sponsored Ads</h2>
	      </div>
	    </div>
	    <div class="row">
	      <div class="col-12  block-13">
	        <div class="owl-carousel nonloop-block-13">
	          <?php
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
	          <?php } ?>
	        </div>
	      </div>
    	</div>
    	<?php } ?>
        <!-- End User Items -->
        <br><br>
        <?php
        	$conds['added_user_id'] = $user_info->user_id;

	        $allitems = $this->Item->get_all_by( $conds )->result();
	        if (count($allitems) != '') {
        ?>
        <div class="row">
	      <div class="col-12">
	        <h2 class="h5 mb-4 text-black">All My Ads</h2>
	      </div>
	    </div>

	    <div class="row">
	      <div class="col-12  block-13">
	        <div class="owl-carousel nonloop-block-13">
	          <?php
	            foreach ($allitems as $all) {

	              $conds = array( 'img_type' => 'item', 'img_parent_id' => $all->id );
	              $images = $this->Image->get_all_by( $conds )->result();
	          ?>
	          <div class="d-block d-md-flex listing vertical">
	            <a href="<?php echo site_url().'/listing_single/'.$paid->item_id; ?>" class="img d-block" style="background-image: url(<?php echo $this->ps_image->upload_url .'/'.$images[0]->img_path; ?>);"></a>
	            <div class="lh-content">
	              <span class="category">
	                <?php 
	                  $cat_id = $this->Item->get_one($all->id)->cat_id;
	                  echo $this->Category->get_one($cat_id)->cat_name;
	                ?>
	              </span>
	              <a href="#" class="bookmark"><span class="icon-heart"></span></a>
	              <h3><a href="<?php echo site_url().'/listing_single/'.$paid->item_id; ?>"><?php echo $this->Item->get_one($all->id)->title; ?></a></h3>
	              <address><?php echo $this->Item->get_one($all->id)->address; ?></address>
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
	          <?php } ?>
	        </div>
	      </div>
    	</div>
    	<?php } ?>
    	<br><br>
    	<!-- Favourite Item -->
        <?php
        	$conds['added_user_id'] = $user_info->user_id;

	        $favitems = $this->Favourite->get_all_by( $conds )->result();
	        if (count($favitems) != '') {
        ?>
        <div class="row">
	      <div class="col-12">
	        <h2 class="h5 mb-4 text-black">Favourite Ads</h2>
	      </div>
	    </div>

	    <div class="row">
	      <div class="col-12  block-13">
	        <div class="owl-carousel nonloop-block-13">
	          <?php
	            foreach ($favitems as $fav) {

	              $conds = array( 'img_type' => 'item', 'img_parent_id' => $fav->item_id );
	              $images = $this->Image->get_all_by( $conds )->result();
	          ?>
	          <div class="d-block d-md-flex listing vertical">
	            <a href="<?php echo site_url().'/listing_single/'.$paid->item_id; ?>" class="img d-block" style="background-image: url(<?php echo $this->ps_image->upload_url .'/'.$images[0]->img_path; ?>);"></a>
	            <div class="lh-content">
	              <span class="category">
	                <?php 
	                  $cat_id = $this->Item->get_one($fav->item_id)->cat_id;
	                  echo $this->Category->get_one($cat_id)->cat_name;
	                ?>
	              </span>
	              <a href="#" class="bookmark"><span class="icon-heart"></span></a>
	              <h3><a href="<?php echo site_url().'/listing_single/'.$paid->item_id; ?>"><?php echo $this->Item->get_one($fav->item_id)->title; ?></a></h3>
	              <address><?php echo $this->Item->get_one($fav->item_id)->address; ?></address>
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
	          <?php } ?>
	        </div>
	      </div>
    	</div>
    	<?php } ?>

      </div>
    </div>