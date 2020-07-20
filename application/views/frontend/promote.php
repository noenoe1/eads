 <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo $this->ps_image->upload_url .'/eads/hero_1.jpg';?>);" data-aos="fade" data-stellar-background-ratio="0.5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">

      <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
        
        
        <div class="row justify-content-center mt-5">
          <div class="col-md-8 text-center">
            <h1>Item Promote</h1>
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
      <?php
        $attributes = array( 'id' => 'paid-form', 'enctype' => 'multipart/form-data');
        echo form_open( site_url('promote'), $attributes);
      ?>
      <?php 
        // show flash message
        flash_msg();
      ?>

      <div class="content animated fadeInRight">
        
        <div class="col-md-9">    

           
              <div class="col-md-8">
                <div class="form-group">
                  <label>
                    <?php echo get_msg('date')?>
                  </label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                    </div>
                     <?php echo form_input(array(
                      'name' => 'date',
                      'value' => set_value( 'date' , $paiditem->date ),
                      'class' => 'form-control',
                      'placeholder' => '',
                      'id' => 'reservation',
                      'size' => '20',
                      'readonly' => 'readonly'
                    )); ?>

                  </div>
                </div>
                
              <button type="submit" class="btn btn-sm btn-primary">
                  <?php echo get_msg('btn_save')?>
              </button>

              <a href="<?php echo $module_site_url; ?>" class="btn btn-sm btn-primary">
                <?php echo get_msg('btn_cancel')?>
              </a>
                   
              </div>
        </div>
      </div>
        
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
</div>