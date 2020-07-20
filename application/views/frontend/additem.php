    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo $this->ps_image->upload_url .'/eads/hero_1.jpg';?>);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center mt-5">
              <div class="col-md-8 text-center">
                <h1>Post an Ads</h1>
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
              $attributes = array( 'id' => 'login-form', 'enctype' => 'multipart/form-data', 'class' => 'p-5 bg-white');
              echo form_open( site_url('additem'), $attributes);
            ?>
             

            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label> <span style="font-size: 17px; color: red;">*</span>
                      <?php echo get_msg('itm_title_label')?>
                    </label>

                    <?php echo form_input( array(
                      'name' => 'title',
                      'value' => set_value( 'title', show_data( @$item->title), false ),
                      'class' => 'form-control form-control-sm',
                      'placeholder' => get_msg('itm_title_label'),
                      'id' => 'title'
                      
                    )); ?>

                  </div>

                  <div class="form-group">
                    <label> <span style="font-size: 17px; color: red;">*</span>
                      <?php echo get_msg('Prd_search_cat')?>
                    </label>

                    <?php
                      $options=array();
                      $conds['status'] = 1;
                      $options[0]=get_msg('Prd_search_cat');
                      $categories = $this->Category->get_all_by($conds);
                      foreach($categories->result() as $cat) {
                          $options[$cat->cat_id]=$cat->cat_name;
                      }

                      echo form_dropdown(
                        'cat_id',
                        $options,
                        set_value( 'cat_id', show_data( @$item->cat_id), false ),
                        'class="form-control form-control-sm mr-3" id="cat_id"'
                      );
                    ?>
                  </div>
                 
                  <div class="form-group">
                    <label> <span style="font-size: 17px; color: red;">*</span>
                      <?php echo get_msg('itm_select_type')?>
                    </label>

                    <?php
                    
                      $options=array();
                      $options[0]=get_msg('itm_select_type');
                      $types = $this->Itemtype->get_all();
                      foreach($types->result() as $typ) {
                          $options[$typ->id]=$typ->name;
                      }

                      echo form_dropdown(
                        'item_type_id',
                        $options,
                        set_value( 'item_type_id', show_data( @$item->item_type_id), false ),
                        'class="form-control form-control-sm mr-3" id="item_type_id"'
                      );
                    ?>
                  </div>

                  <div class="form-group">
                    <label> <span style="font-size: 17px; color: red;">*</span>
                      <?php echo get_msg('itm_select_location')?>
                    </label>

                    <?php
                    
                      $options=array();
                      $options[0]=get_msg('itm_select_location');
                      $locations = $this->Itemlocation->get_all();
                      foreach($locations->result() as $location) {
                          $options[$location->id]=$location->name;
                      }

                      echo form_dropdown(
                        'item_location_id',
                        $options,
                        set_value( 'item_location_id', show_data( @$item->item_location_id), false ),
                        'class="form-control form-control-sm mr-3" id="item_location_id"'
                      );
                    ?>
                  </div>

                  <div class="form-group">
                      <label> <span style="font-size: 17px; color: red;">*</span>
                        <?php echo get_msg('itm_select_deal_option')?>
                      </label>

                      <?php
                        $options=array();
                        $conds['status'] = 1;
                        $options[0]=get_msg('deal_option_id_label');
                        $deals = $this->Option->get_all_by($conds);
                        foreach($deals->result() as $deal) {
                            $options[$deal->id]=$deal->name;
                        }

                        echo form_dropdown(
                          'deal_option_id',
                          $options,
                          set_value( 'deal_option_id', show_data( @$item->deal_option_id), false ),
                          'class="form-control form-control-sm mr-3" id="deal_option_id"'
                        );
                      ?>
                  </div>

                  <div class="form-group">
                    <label> <span style="font-size: 17px; color: red;">*</span>
                      <?php echo get_msg('item_description_label')?>
                    </label>

                    <?php echo form_textarea( array(
                      'name' => 'description',
                      'value' => set_value( 'description', show_data( @$item->description), false ),
                      'class' => 'form-control form-control-sm',
                      'placeholder' => get_msg('item_description_label'),
                      'id' => 'description',
                      'rows' => "3"
                    )); ?>

                  </div>

                  <div class="form-group">
                    <label> <span style="font-size: 17px; color: red;">*</span>
                      <?php echo get_msg('prd_high_info')?>
                    </label>

                    <?php echo form_textarea( array(
                      'name' => 'highlight_info',
                      'value' => set_value( 'info', show_data( @$item->highlight_info), false ),
                      'class' => 'form-control form-control-sm',
                      'placeholder' => get_msg('ple_highlight_info'),
                      'id' => 'info',
                      'rows' => "3"
                    )); ?>

                  </div>
                  <!-- form group -->
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label> <span style="font-size: 17px; color: red;">*</span>
                      <?php echo get_msg('price')?>
                    </label>

                    <?php echo form_input( array(
                      'name' => 'price',
                      'value' => set_value( 'price', show_data( @$item->price), false ),
                      'class' => 'form-control form-control-sm',
                      'placeholder' => get_msg('price'),
                      'id' => 'price'
                      
                    )); ?>

                  </div>

                  <div class="form-group">
                    <label> <span style="font-size: 17px; color: red;">*</span>
                      <?php echo get_msg('Prd_search_subcat')?>
                    </label>

                    <?php
                      if(isset($item)) {
                        $options=array();
                        $options[0]=get_msg('Prd_search_subcat');
                        $conds['cat_id'] = $item->cat_id;
                        $sub_cat = $this->Subcategory->get_all_by($conds);
                        foreach($sub_cat->result() as $subcat) {
                          $options[$subcat->id]=$subcat->name;
                        }
                        echo form_dropdown(
                          'sub_cat_id',
                          $options,
                          set_value( 'sub_cat_id', show_data( @$item->sub_cat_id), false ),
                          'class="form-control form-control-sm mr-3" id="sub_cat_id"'
                        );

                      } else {
                        $conds['cat_id'] = $selected_cat_id;
                        $options=array();
                        $options[0]=get_msg('Prd_search_subcat');

                        echo form_dropdown(
                          'sub_cat_id',
                          $options,
                          set_value( 'sub_cat_id', show_data( @$item->sub_cat_id), false ),
                          'class="form-control form-control-sm mr-3" id="sub_cat_id"'
                        );
                      }
                      
                    ?>

                  </div>

                  <div class="form-group">
                    <label> <span style="font-size: 17px; color: red;">*</span>
                      <?php echo get_msg('itm_select_price')?>
                    </label>

                    <?php
                      $options=array();
                      $conds['status'] = 1;
                      $options[0]=get_msg('itm_select_price');
                      $pricetypes = $this->Pricetype->get_all_by($conds);
                      foreach($pricetypes->result() as $price) {
                          $options[$price->id]=$price->name;
                      }

                      echo form_dropdown(
                        'item_price_type_id',
                        $options,
                        set_value( 'item_price_type_id', show_data( @$item->item_price_type_id), false ),
                        'class="form-control form-control-sm mr-3" id="item_price_type_id"'
                      );
                    ?>
                  </div>

                  <div class="form-group">
                    <label> <span style="font-size: 17px; color: red;">*</span>
                      <?php echo get_msg('itm_select_currency')?>
                    </label>

                    <?php
                      $options=array();
                      $conds['status'] = 1;
                      $options[0]=get_msg('itm_select_currency');
                      $currency = $this->Currency->get_all_by($conds);
                      foreach($currency->result() as $curr) {
                          $options[$curr->id]=$curr->currency_short_form;
                      }

                      echo form_dropdown(
                        'item_currency_id',
                        $options,
                        set_value( 'item_currency_id', show_data( @$item->item_currency_id), false ),
                        'class="form-control form-control-sm mr-3" id="item_currency_id"'
                      );
                    ?>
                  </div>

                  <div class="form-group">
                    <label> <span style="font-size: 17px; color: red;">*</span>
                      <?php echo get_msg('itm_select_condition_of_item')?>
                    </label>

                    <?php
                      $options=array();
                      $conds['status'] = 1;
                      $options[0]=get_msg('condition_of_item');
                      $conditions = $this->Condition->get_all_by($conds);
                      foreach($conditions->result() as $cond) {
                          $options[$cond->id]=$cond->name;
                      }

                      echo form_dropdown(
                        'condition_of_item_id',
                        $options,
                        set_value( 'condition_of_item_id', show_data( @$item->condition_of_item_id), false ),
                        'class="form-control form-control-sm mr-3" id="condition_of_item_id"'
                      );
                    ?>
                  </div>

                  <div class="form-group" style="padding-top: 30px;">
                    <div class="form-check">

                      <label>
                      
                        <?php echo form_checkbox( array(
                          'name' => 'status',
                          'id' => 'status',
                          'value' => 'accept',
                          'checked' => set_checkbox('status', 1, ( @$item->status == 1 )? true: false ),
                          'class' => 'form-check-input'
                        )); ?>

                        <?php echo get_msg( 'status' ); ?>
                      </label>
                    </div>
                  </div>

                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label> <span style="font-size: 17px; color: red;">*</span>
                      <?php echo get_msg('brand_label')?>
                    </label>

                    <?php echo form_input( array(
                      'name' => 'brand',
                      'value' => set_value( 'brand', show_data( @$item->brand), false ),
                      'class' => 'form-control form-control-sm',
                      'placeholder' => get_msg('brand_label'),
                      'id' => 'brand'
                      
                    )); ?>

                  </div>

                  <?php if ( !isset( $item )): ?>

                    <div class="form-group">
                      <span style="font-size: 17px; color: red;">*</span>
                      <label><?php echo get_msg('itm_img')?>
                        <a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('cat_photo_tooltips')?>">
                          <span class='glyphicon glyphicon-info-sign menu-icon'>
                        </a>
                      </label>

                      <br/>

                      <input class="btn btn-sm" type="file" name="images1">
                    </div>

                  <?php endif; ?> 
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <div class="form-check">
                      <label>
                      
                      <?php echo form_checkbox( array(
                        'name' => 'business_mode',
                        'id' => 'business_mode',
                        'value' => 'accept',
                        'checked' => set_checkbox('business_mode', 1, ( @$item->business_mode == 1 )? true: false ),
                        'class' => 'form-check-input'
                      )); ?>

                      <?php echo get_msg( 'itm_business_mode' ); ?>
                      <br><?php echo get_msg( 'itm_show_shop' ) ?>
                      </label>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="form-check">
                      <label>
                      
                      <?php echo form_checkbox( array(
                        'name' => 'is_sold_out',
                        'id' => 'is_sold_out',
                        'value' => 'accept',
                        'checked' => set_checkbox('is_sold_out', 1, ( @$item->is_sold_out == 1 )? true: false ),
                        'class' => 'form-check-input'
                      )); ?>

                      <?php echo get_msg( 'itm_is_sold_out' ); ?>

                      </label>
                    </div>
                  </div>
                  <!-- form group -->
                </div>
                <div class="col-md-6">
                   <br><br>
                  <legend><?php echo get_msg('location_info_label'); ?></legend>
                  <div class="form-group">
                    <label> <span style="font-size: 17px; color: red;">*</span>
                      <?php echo get_msg('itm_address_label')?>
                    </label>

                    <?php echo form_textarea( array(
                      'name' => 'address',
                      'value' => set_value( 'address', show_data( @$item->address), false ),
                      'class' => 'form-control form-control-sm',
                      'placeholder' => get_msg('itm_address_label'),
                      'id' => 'address',
                      'rows' => "5"
                    )); ?>

                  </div>
                </div>
                <?php if (  @$item->lat !='0' && @$item->lng !='0' ):?>
                <div class="col-md-6">
                  <div id="itm_location" style="width: 100%; height: 400px;"></div>
                  <div class="clearfix">&nbsp;</div>
                  <div class="form-group">
                    <label><?php echo get_msg('itm_lat_label') ?>
                      <a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('city_lat_label')?>">
                        <span class='glyphicon glyphicon-info-sign menu-icon'>
                      </a>
                    </label>

                    <br>

                    <?php 
                      echo form_input( array(
                        'type' => 'text',
                        'name' => 'lat',
                        'id' => 'lat',
                        'class' => 'form-control',
                        'placeholder' => '',
                        'value' => set_value( 'lat', show_data( @$item->lng ), false ),
                      ));
                    ?>
                  </div>
                  <div class="form-group">
                    <label><?php echo get_msg('itm_lng_label') ?>
                      <a href="#" class="tooltip-ps" data-toggle="tooltip" 
                        title="<?php echo get_msg('city_lng_tooltips')?>">
                        <span class='glyphicon glyphicon-info-sign menu-icon'>
                      </a>
                    </label>

                    <br>

                    <?php 
                      echo form_input( array(
                        'type' => 'text',
                        'name' => 'lng',
                        'id' => 'lng',
                        'class' => 'form-control',
                        'placeholder' => '',
                        'value' =>  set_value( 'lat', show_data( @$item->lng ), false ),
                      ));
                    ?>
                  </div>
                  <!-- form group -->
                </div>

                <?php endif ?>
                
              </div>
              <!-- row -->
            </div>

            
            <button type="submit" class="btn btn-sm btn-primary">
              <?php echo get_msg('btn_save')?>
            </button>

           <!--  <button type="submit" name="gallery" id="gallery" class="btn btn-sm btn-primary" style="margin-top: 3px;">
              <?php echo get_msg('btn_save_gallery')?>
            </button> -->

           <!--  <button type="submit" name="promote" id="promote" class="btn btn-sm btn-primary" style="margin-top: 3px;">
              <?php echo get_msg('btn_promote')?>
            </button> -->
            
            <a href="<?php echo $module_site_url; ?>" class="btn btn-sm btn-primary">
              <?php echo get_msg('btn_cancel')?>
            </a>
           

  
            <?php echo form_close(); ?>
          </div>
         
        </div>
      </div>
    </div>
    <script src="<?php echo base_url( 'assets/jquery/jquery.min.js' ); ?>"></script>
    <script>

      $('#cat_id').on('change', function() {

        var value = $('option:selected', this).text().replace(/Value\s/, '');

        var catId = $(this).val();
        // alert(catId);
        $.ajax({
          url: '<?php echo site_url() . '/get_all_sub_categories/';?>' + catId,
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
    </script>