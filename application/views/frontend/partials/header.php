<!DOCTYPE html>
<html lang="en">
  <head>
    <title>EAds </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url( 'assets/frontend/fonts/icomoon/style.css' ); ?>">
    <link rel="stylesheet" href="<?php echo base_url( 'assets/frontend/css/bootstrap.min.css' ); ?>">
    <link rel="stylesheet" href="<?php echo base_url( 'assets/frontend/css/magnific-popup.css' ); ?>">
    <link rel="stylesheet" href="<?php echo base_url( 'assets/frontend/css/jquery-ui.css' ); ?>">
    <link rel="stylesheet" href="<?php echo base_url( 'assets/frontend/css/owl.carousel.min.css' ); ?>">
    <link rel="stylesheet" href="<?php echo base_url( 'assets/frontend/css/owl.theme.default.min.css' ); ?>">

    <link rel="stylesheet" href="<?php echo base_url( 'assets/frontend/css/bootstrap-datepicker.css' ); ?>">

    <link rel="stylesheet" href="<?php echo base_url( 'assets/frontend/fonts/flaticon/font/flaticon.css' ); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url( 'assets/frontend/css/aos.css' ); ?>">
    <link rel="stylesheet" href="<?php echo base_url( 'assets/frontend/css/rangeslider.css' ); ?>">

    <link rel="stylesheet" href="<?php echo base_url( 'assets/frontend/css/style.css' ); ?>">
    <!-- gallery lightbox -->
    <link rel="stylesheet" href="<?php echo base_url('assets/gallery/gallery.css'); ?>">
    <script src="<?php echo base_url('assets/plugins/gallery/gallery.js');?>"></script>
    
  </head>
<body>
    <div class="site-wrap">

        <div class="site-mobile-menu">
          <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
              <span class="icon-close2 js-menu-toggle"></span>
            </div>
          </div>
          <div class="site-mobile-menu-body"></div>
        </div>
    
        <header class="site-navbar container py-0 bg-white" role="banner">

          <!-- <div class="container"> -->
            <div class="row align-items-center">
              
              <div class="col-6 col-xl-2">
                <h1 class="mb-0 site-logo"><a href="<?php echo site_url().'/home'; ?>" class="text-black mb-0">E<span class="text-primary">Ads</span>  </a></h1>
              </div>
              <div class="col-12 col-md-10 d-none d-xl-block">
                <nav class="site-navigation position-relative text-right" role="navigation">

                  <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                    <li class="active"><a href="<?php echo site_url().'/home'; ?>">Home</a></li>
                    <li><a href="<?php echo site_url().'/advancedsearch'; ?>">Advanced Search</a></li>
                    <li><a href="<?php echo site_url().'/blog'; ?>">Blog</a></li>
                    <li><a href="<?php echo site_url().'/contact'; ?>">Contact</a></li>

                    <?php if ( !isset( $user_info )): ?>

                      <li class="ml-xl-3 login"><a href="<?php echo site_url().'/userlogin'; ?>"><span class="border-left pl-xl-4"></span>Log In</a></li>
                      <li><a href="<?php echo site_url().'/register'; ?>">Register</a></li>
                    <?php else: ?>

                      <li class="ml-xl-3 login"><a href="<?php echo site_url().'/userprofile'; ?>"><span class="border-left pl-xl-4"></span>My Profile</a></li>

                      <li class="ml-xl-3 login"><a href="<?php echo site_url().'/userlogout'; ?>"><span class="border-left pl-xl-4"></span>Log Out</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo site_url().'/additem'; ?>" class="cta"><span class="bg-primary text-white rounded">+ Post an Ad</span></a></li>
                  </ul>
                </nav>
              </div>


              <div class="d-inline-block d-xl-none ml-auto py-3 col-6 text-right" style="position: relative; top: 3px;">
                <a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a>
              </div>

            </div>
          <!-- </div> -->
          
        </header>