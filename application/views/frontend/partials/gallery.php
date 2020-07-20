<!-- Nav Image -->
<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo $this->ps_image->upload_url .'/eads/hero_1.jpg';?>);" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">

            <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
                
                
                <div class="row justify-content-center mt-5">
                  <div class="col-md-8 text-center">
                    <h1>Image Gallery</h1>
                  </div>
                </div>

                
            </div>
        </div>
    </div>
</div>  
<!-- end Image -->
				
<?php $this->load->view( $template_path .'/components/gallery' ); ?>

<?php $this->load->view( $template_path .'/components/gallery_script' ); ?>
