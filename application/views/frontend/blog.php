<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo $this->ps_image->upload_url .'/eads/hero_1.jpg';?>);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center mt-5">
              <div class="col-md-8 text-center">
                <h1>Blog</h1>
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
            <?php $count = $this->uri->segment(4) or $count = 0; ?>
            <?php if ( !empty( $blogs ) && count( $blogs->result()) > 0 ): ?>
            <?php 
                foreach($blogs->result() as $blog) {
                $conds = array( 'img_type' => 'blog', 'img_parent_id' => $blog->id );
                $images = $this->Image->get_all_by( $conds )->result();
            ?>
              <div class="col-md-6 col-lg-6 mb-4 mb-lg-4">
                <div class="h-entry">
                  <a href="<?php echo site_url() . '/blogdetail/'.$blog->id ?>">
                  <img src="<?php echo $this->ps_image->upload_url . $images[0]->img_path; ?>" alt="Image" class="img-fluid rounded"></a>
                  <h2 class="font-size-regular"><a href="<?php echo site_url() . '/blogdetail/'.$blog->id ?>" class="text-black"><?php echo $blog->name;?></a></h2>
                  <?php 
                    $added_date = $blog->added_date;
                    $dt = strtotime($added_date);
                    $day = date("d", $dt);
                    $month = date("M",$dt);
                    $year = date("Y",$dt);
                  ?>
                  <div class="meta mb-3">by <?php echo $this->User->get_one($blog->added_user_id)->user_name; ?><span class="mx-1">&bullet;</span> <?php echo $month." ".$day.",".$year; ?><span class="mx-1">&bullet;</span></div>
                  <p>
                    <?php 
                      $length = 150; 
                      $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $blog->description);
                      echo $text; 
                    ?>
                  </p>
                </div> 
              </div>
            <?php } ?>
            <?php endif ?> 
            </div>


            <div style="text-align: center; font-size: 36px;">
              <?php if( $current!=1 ) { ?>
                <a href="<?php echo site_url('/blog/'.($current-1)) ?>">

                  <span class="fa fa-caret-left" style="color: red;font-size: 50px;margin-top: -5px;"></span>
                  
                </a>
              <?php } ?> 
              <?php if( $noofpage > $current ) { ?>
                <a href="<?php echo site_url('/blog/'.($current+1)) ?>">
                  
                  <span class="fa fa-caret-right" style="color: red;font-size: 50px;margin-top: -5px;"></span>

                </a>
              <?php } ?>
            </div>
          </div>
          
        </div>
      </div>
    </div>