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
            $attributes = array( 'id' => 'advanced-form', 'enctype' => 'multipart/form-data');
            echo form_open( site_url('advancedsearch'), $attributes);
          ?>
            <div class="row align-items-center">
              <div class="col-lg-12 mb-4 mb-xl-0 col-xl-4">
                <input type="text" name="title" id="title" value="<?php echo $item_title; ?>" class="form-control rounded" placeholder="What are you looking for?">
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
             
              <div class="col-lg-12 mb-4 mb-xl-0 col-xl-3">
                <div class="select-wrap">
                  <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
                  <select class="form-control rounded" name="sub_cat_id" id="sub_cat_id">
                    <option value="0">Load all subcategories</option>
                    <?php
                      $subcategories = $this->Subcategory->get_all( )->result();
                      foreach($subcategories as $subcat) {

                        if ($subcat->id == $cat_id) {
                            echo '<option value="'.$subcat->id.'" selected>'.$subcat->name.'</option>';   
                        } else {
                          echo '<option value="'.$subcat->id.'">'.$subcat->name.'</option>'; 
                        }      
                      }
                    ?>
                    
                  </select>
                </div>
              </div>
              
            </div>

            <div class="row align-items-center" style="padding-top: 2px;">
              <div class="col-lg-12 mb-4 mb-xl-0 col-xl-4">
                <div class="select-wrap">
                  <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
                  <select class="form-control rounded" name="item_type_id" id="item_type_id">
                    <option value="0">Load all item type</option>
                    <?php
                      $types = $this->Itemtype->get_all( )->result();
                      foreach($types as $typ) {
                        if ($typ->id == $item_type_id) {
                          echo '<option value="'.$typ->id.'" selected>'.$typ->name.'</option>'; 
                        } else {
                          echo '<option value="'.$typ->id.'">'.$typ->name.'</option>'; 
                        }      
                      }
                    ?>
                    
                  </select>
                </div>
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
                  <select class="form-control rounded" name="condition_of_item_id" id="condition_of_item_id">
                    <option value="0">Load all item condition</option>
                    <?php
                      $conditions = $this->Condition->get_all( )->result();
                      foreach($conditions as $cond) {

                        if ($cond->id == $cat_id) {
                            echo '<option value="'.$cond->id.'" selected>'.$cond->name.'</option>';   
                        } else {
                          echo '<option value="'.$cond->id.'">'.$cond->name.'</option>'; 
                        }      
                      }
                    ?>
                    
                  </select>
                </div>
              </div>
            </div>

            <div class="row align-items-center">
              <div class="col-lg-12 mb-4 mb-xl-0 col-xl-4">
                <div class="row">
                  <div class="col-lg-12 mb-4 mb-xl-0 col-xl-3">
                    <label><b>Price : </b></label>
                  </div>
                  <div class="col-lg-12 mb-4 mb-xl-0 col-xl-4">
                   <input type="text" name="price" id="price" value="<?php echo $price; ?>" class="form-control rounded">
                  </div>
                </div>
                
              </div>
              <div class="col-lg-12 mb-4 mb-xl-0 col-xl-3">
                <div class="select-wrap">
                  <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
                  <select class="form-control form-control-sm mr-3" name="price_status" id="price_status">
              
                    <option value="0"><?php echo get_msg('select_status_label');?></option>

                      <?php
                        $array = array('equal' => 1, 'greater' => 2, 'less than' => 3);
                          foreach ($array as $key=>$value) {

                            if($value == $status) {
                              echo '<option value="'.$value.'" selected>'.$key.'</option>';
                            } else {
                              echo '<option value="'.$value.'">'.$key.'</option>';
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
              <?php if( $current!=1 && $current!="" ) { ?>
                <a href="<?php echo site_url('/advancedsearch/'.($current-1)) ?>">

                  <span class="fa fa-caret-left" style="color: red;font-size: 50px;margin-top: -5px;"></span>
                  
                </a>
              <?php } ?> 
              <?php if( $noofpage > $current ) { ?>
                <a href="<?php echo site_url('/advancedsearch/'.($current+1)) ?>">
                  
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
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<script>
  $(document).ready(function(){
    $('#cat_id').on('change', function() {

        var value = $('option:selected', this).text().replace(/Value\s/, '');

        var catId = $(this).val();

        $.ajax({
          url: '<?php echo $module_site_url . '/get_all_sub_categories/';?>' + catId,
          method: 'GET',
          dataType: 'JSON',
          success:function(data){
            $('#sub_cat_id').html("");
            $.each(data, function(i, obj){
                $('#sub_cat_id').append('<option value="'+ obj.id +'">' + obj.name+ '</option>');
            });
            $('#name').val($('#name').val() + " ").blur();
            $('#sub_cat_id').trigger('change');
          }
        });
    });
  });
</script>