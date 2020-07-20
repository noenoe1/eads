<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo $this->ps_image->upload_url .'/eads/hero_1.jpg';?>);" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">

      <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
        
        
        <div class="row justify-content-center mt-5">
          <div class="col-md-8 text-center">
            <h1>Categories</h1>
          </div>
        </div>

        
      </div>
    </div>
  </div>
</div> 

<div class="site-section" data-aos="fade">
  <div class="container">

    <div class="row">
      <?php $count = $this->uri->segment(4) or $count = 0; ?>
      <?php if ( !empty( $categories ) && count( $categories->result()) > 0 ): ?>
      <?php 
          foreach($categories->result() as $cat) {
          $conds = array( 'img_type' => 'category', 'img_parent_id' => $cat->cat_id );
          $images = $this->Image->get_all_by( $conds )->result();
          $item_count = $this->Item->count_all_by(array('cat_id' => $cat->cat_id, ));
      ?>
        <div class="col-md-6 mb-4 mb-lg-4 col-lg-4">
          
          <div class="listing-item">
            <div class="listing-image">
              <img src="<?php echo $this->ps_image->upload_url . $images[0]->img_path; ?>" alt="Image" class="img-fluid">
            </div>
            <div class="listing-item-content">
              <a class="px-3 mb-3 category" href="<?php echo site_url().'/listing/'.$cat->cat_id; ?>"><?php echo $item_count; ?> Ads</a>
              <h2 class="mb-1"><a href="<?php echo site_url().'/listing/'.$cat->cat_id; ?>"><?php echo $cat->cat_name?></a></h2>
            </div>
          </div>

        </div>
            
      <?php } ?>
      <?php endif ?>
        </div>
      </div>
    </div>