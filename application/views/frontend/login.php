<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo $this->ps_image->upload_url .'/eads/hero_1.jpg';?>);" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">

      <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
        
        
        <div class="row justify-content-center mt-5">
          <div class="col-md-8 text-center">
            <h1>Log In</h1>
          </div>
        </div>

        
      </div>
    </div>
  </div>
</div>  

<div class="site-section bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 mb-5"  data-aos="fade">

        

        <?php
          $attributes = array( 'id' => 'login-form', 'enctype' => 'multipart/form-data');
            echo form_open( site_url('userlogin'), $attributes);
        ?>
         
          <div class="row form-group">
            
            <div class="col-md-12">
              <label class="text-black" for="email">Email</label> 
              <input type="email" id="user_email" name="user_email" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            
            <div class="col-md-12">
              <label class="text-black" for="subject">Password</label> 
              <input type="password" id="user_password" name="user_password" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-12">
              <p>No account yet? <a href="<?php echo site_url() . '/register';?>">Register</a> | <a href="<?php echo site_url() . '/reset_password';?>">Forgot Password?</a></p>
            </div>
          </div>

        
          <div class="row form-group">
            <div class="col-md-12">
              <input type="submit" value="Sign In" name="submit" class="btn btn-primary py-2 px-4 text-white">
            </div>
          </div>


        <?php echo form_close(); ?>
      </div>
      
    </div>
  </div>
</div>