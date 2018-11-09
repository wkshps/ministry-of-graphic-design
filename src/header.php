<!doctype html>
<html <?php language_attributes(); ?> class="loading">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, viewport-fit=cover">
  <meta name="description" content="<?php bloginfo('description'); ?>">
  <title><?php wp_title('&mdash;', true, 'right'); bloginfo('name'); ?></title>
  <?php wp_head(); ?>
  <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window,document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
     fbq('init', '596130974174147');
    fbq('track', 'PageView');
  </script>
  <noscript>
    <img height="1" width="1"
  src="https://www.facebook.com/tr?id=596130974174147&ev=PageView
  &noscript=1"/>
  </noscript>
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-126808102-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-126808102-1');
  </script>
</head>
<body <?php body_class(); ?>>
  <a href="<?php the_field('tickets_url', 'option'); ?>" class="tickets-button"><p class="arabic-text"><?php the_field('tickets_text_arabic', 'option'); ?></p><p><?php the_field('tickets_text', 'option'); ?></p></a>
  <div class="slider">
    <div class="slider-label slider-label-1">EN</div>
    <input type="range" min="0" max="180" step="1" value="45">
    <div class="slider-label arabic-text slider-label-2">عربي</div>
  </div>
  <div class="logo-container">
    <div class="flipper flipper-logo">
      <div class="front">
        <h1 class="logo logo-english">Ministry of Graphic Design</h1>
      </div>
      <div class="back">
        <h1 class="logo logo-arabic">Ministry of Graphic Design</h1>
      </div>
    </div>
  </div>

  <header class="site-header">
    <h1 class="title-english"><a href="/"><?php the_field('heading_top_left', 'option'); ?></a></h1>
    <h1 class="title-arabic arabic-text"><a href="/"><?php the_field('heading_top_right', 'option'); ?></a></h1>
    <h2 class="heading-bottom-left"><a href="/"><?php the_field('heading_bottom_left', 'option'); ?></a></h2>
    <h2 class="heading-bottom-right"><a href="/"><?php the_field('heading_bottom_right', 'option'); ?></a></h2>
  </header>

  <nav class="site-nav">
    <?php
      wp_nav_menu(array(
        'theme_location' => 'main-menu',
        'container' => null,
        'item_spacing' => 'discard'
      ));
    ?>
  </nav>
  <button class="site-nav-toggle">Menu</button>
  <div class="main">
