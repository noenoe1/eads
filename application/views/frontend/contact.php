    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo $this->ps_image->upload_url .'/eads/hero_1.jpg';?>);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center mt-5">
              <div class="col-md-8 text-center">
                <h1>Contact Us</h1>
                <p class="mb-0">Get In Touch</p>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>  

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-5"  data-aos="fade">
            <?php flash_msg(); ?>
            <?php
              $attributes = array( 'id' => 'contact-form', 'enctype' => 'multipart/form-data', 'class' => 'p-5 bg-white');
              echo form_open( site_url('contact'), $attributes);
            ?>
             
              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="contact_name">Name</label>
                  <input type="text" id="contact_name" name="contact_name" class="form-control">
                </div>
                <div class="col-md-6">
                   <label class="text-black" for="contact_email">Email</label> 
                  <input type="email" id="contact_email" name="contact_email" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="contact_phone">Phone</label>
                  <input type="text" id="contact_phone" name="contact_phone" class="form-control">
                </div>

                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="contact_message">Message</label> 
                  <textarea name="contact_message" id="contact_message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send Message" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>

            <?php echo form_close(); ?>
          </div>
         
        </div>
      </div>
    </div>