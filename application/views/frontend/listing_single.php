<?php $logged_in_user = $this->ps_auth->get_user_info(); ?>
<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo $this->ps_image->upload_url .'/eads/hero_1.jpg';?>);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center mt-5">
              <div class="col-md-8 text-center">
                <h1><?php echo $item->title; ?></h1>
                <p class="mb-0"><?php echo $item->address; ?></p>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <!-- Grid row -->
        <?php if ( isset( $item )): ?>
        <div class="gallery" id="gallery" style="margin-left: 15px; margin-bottom: 15px;">
          <?php
              $conds = array( 'img_type' => 'item', 'img_parent_id' => $item->id );
              $images = $this->Image->get_all_by( $conds )->result();
          ?>
          <?php $i = 0; foreach ( $images as $img ) :?>
            <!-- Grid column -->
            <div class="mb-3 pics animation all 2">
              <a href="#<?php echo $i;?>"><img class="img-fluid" src="<?php echo img_url('/' . $img->img_path); ?>" alt="Card image cap"></a>
            </div>
            <!-- Grid column -->
          <?php $i++; endforeach; ?>

          <?php $i = 0; foreach ( $images as $img ) :?>
            <a href="#_1" class="lightbox trans" id="<?php echo $i?>"><img src="<?php echo img_url('/' . $img->img_path); ?>"></a>
          <?php $i++; endforeach; ?>
        </div>
        <?php endif; ?>
        <!-- Grid row -->

          </div>
          <div class="col-lg-8">
            <div class="alert alert-success" style="display: none;"></div>
            <h4 class="h5 mb-4 text-black"><?php echo $item->title; ?></h4>
            <h4 class="h5 mb-4 text-black">Description</h4>
            <p><?php echo $item->description; ?></p>
            <h4 class="h5 mb-4 text-black">Highlighted Information</h4>
            <p><?php echo $item->highlight_info; ?></p>
            <h4 class="h5 mb-4 text-black">Deal Option : <?php echo $this->Option->get_one($item->deal_option_id)->name; ?></h4>
             <h4 class="h5 mb-4 text-black">Brand : <?php echo $item->brand; ?></h4>
            <?php if ( isset( $logged_in_user->user_id )){ ?>
            <div class='starrr' id='star1'></div>
            <div>&nbsp;
              <span class='your-choice-was' style='display: none;'>
                Your rating was <span class='choice'></span>.
              </span>
            </div>
            <br>
            <div class="col-xl-3" id="press">
              <a herf='#' class='btn btn-primary btn-block rounded'>Add To Favourite</a>
            </div>
            <input type="hidden" name="item_id" id="item_id" value="<?php echo $item->id; ?>">
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $logged_in_user->user_id; ?>">
            <input type="hidden" name="to_user_id" id="to_user_id" value="<?php echo $item->added_user_id; ?>">
            <?php } ?>
          </div>

          <div class="col-lg-4 ml-auto">
            <h4 class="h5 mb-4 text-black">Address</h4>
            <p><?php echo $item->address; ?></p>
            <?php if (  $item->lat !='0' && $item->lng !='0' ):?>
          
            <div id="itm_location" style="width: 100%; height: 250px;"></div>
            <div class="clearfix">&nbsp;</div>
          
            <?php endif ?>
           
                <h4 class="h5 mb-4 text-black">Category : 

                    <?php echo $this->Category->get_one($item->cat_id)->cat_name; ?> 
                  
                </h4>
                
                <h4 class="h5 mb-4 text-black">Sub Category : <?php echo $this->Subcategory->get_one($item->sub_cat_id)->name; ?></h4>
                <h4 class="h5 mb-4 text-black">Price : <?php echo $item->price . $this->Currency->get_one($item->item_currency_id)->currency_symbol; ?></h4>
                <h4 class="h5 mb-4 text-black">For : <?php echo $this->Itemtype->get_one($item->item_type_id)->name; ?></h4>
                <h4 class="h5 mb-4 text-black">Item Condition : <?php echo $this->Condition->get_one($item->condition_of_item_id)->name; ?></h4>
                
                <h4 class="h5 mb-4 text-black">Ratings : 
                
                  <?php
                  //Rating Calculation Here 
                  
                  $conds['to_user_id'] = $item->added_user_id;
                  
                  //$ratings = $this->get_room_ratings( $room_id );
                  $ratings = $this->Rate->get_all_by( $conds )->result();

                  $rating_count_value = count($ratings); 
                  $rating_total_value = 0;
                  foreach ( $ratings as $rat ) {
                  // loop each rating and get total
                    $rating_total_value += $rat->rating;
                  }
                  $final_rating =  $rating_total_value/$rating_count_value;



                  ?>
                
                  <?php
                  
                  for($i=1; $i<=5;$i++) {
                    if($i < $final_rating) {
                      echo "<span class='fa fa-star checked'></span>";
                    } else {
                      echo "<span class='fa fa-star'></span>";
                    }

                  }
                  ?>
                  
                
                </h4>

              
          </div>
        </div>
      </div>
    </div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<script>
  $(document).ready(function(){
    // add to fav button listener
    $('#press').on('click', function(){
      var obj = {};
      obj.item_id = $('#item_id').val();
      obj.user_id = $('#user_id').val();
      $.ajax({
          type: 'POST',
          url: '<?php echo site_url() . '/guestajax/add_favourite_items';?>',
          data: obj,
          dataType:'json',
          success:function(resp){
              // alert(resp.data);
              if ( resp.status == 'success' ) {
                  $('.alert-success').show();
                  $( '.alert-success' ).html( "<strong>Success!</strong> Add To Favourite." );

              } else {
                  console.log( resp );
              }
          }
      });
    });
    //rating star
    $('#star1').starrr({
      change: function(e, value){
        var obj = {};
        obj.rating = value;
        obj.from_user_id = $('#user_id').val();
        obj.to_user_id = $('#to_user_id').val();
        $.ajax({
          type: 'POST',
          url: '<?php echo site_url() . '/guestajax/add_rating';?>',
          data: obj,
          dataType:'json',
          success:function(resp){
              alert(resp.data);
              if ( resp.status == 'success' ) {
                  $('.alert-success').show();
                  $( '.alert-success' ).html( "<strong>Success!</strong> Rating." );
                  if (value) {
                    $('.your-choice-was').show();
                    $('.choice').text(value);
                  }

              } else {
                  console.log( resp );
              }
          }
      });
        if (value) {
          $('.your-choice-was').show();
          $('.choice').text(value);
        } else {
          $('.your-choice-was').hide();
        }
      }
    });

    var $s2input = $('#star2_input');
    $('#star2').starrr({
      max: 10,
      rating: $s2input.val(),
      change: function(e, value){
        $s2input.val(value).trigger('input');
      }
    });
  });
</script>
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-39205841-5', 'dobtco.github.io');
  ga('send', 'pageview');
</script>