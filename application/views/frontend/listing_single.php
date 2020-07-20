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
          <div class="col-lg-8">
            <div class="alert alert-success" style="display: none;"></div>
            <div class="mb-4">
              <div class="slide-one-item home-slider owl-carousel">

                <?php

                  $conds = array( 'img_type' => 'item', 'img_parent_id' => $item->id );
                  
                  $images = $this->Image->get_all_by( $conds )->result();

                ?>
                <div><img src="<?php echo $this->ps_image->upload_url . $images[0]->img_path; ?>" alt="Image" class="img-fluid"></div>
              </div>
            </div>
            
            <h4 class="h5 mb-4 text-black">Description</h4>
            <p><?php echo $item->description; ?></p>
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
      alert(obj);
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