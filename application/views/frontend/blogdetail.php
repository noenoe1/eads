<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo $this->ps_image->upload_url .'/eads/hero_1.jpg';?>);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center mt-5">
              <div class="col-md-8 text-center">
                <h1>Single Blog</h1>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
        <div class="row">

          <div class="col-md-8">

            <div class="row mb-3 align-items-stretch">
            <?php

              $conds = array( 'img_type' => 'blog', 'img_parent_id' => $blog->id );
              
              $images = $this->Image->get_all_by( $conds )->result();

            ?>
              <div class="col-md-12 col-lg-12 mb-4 mb-lg-4">
                <div class="h-entry">
                  
                  <img class="img-fluid" src="<?php echo $this->ps_image->upload_url . $images[0]->img_path; ?>" alt="">
                  <h2 class="font-size-regular"><?php echo $blog->name;?></h2>
                  
                  <p><?php echo $blog->description; ?></p>
                </div> 
              </div>
            
            </div>

          </div>
          
        </div>
      </div>
    </div>