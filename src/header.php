<!doctype html>
<html <?php language_attributes(); ?> class="loading">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, viewport-fit=cover">
  <meta name="description" content="<?php bloginfo('description'); ?>">
  <title><?php wp_title('&mdash;', true, 'right'); bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <div class="slider">
    <div class="slider-label slider-label-1">EN</div>
    <input type="range" min="0" max="180" step="1" value="45">
    <div class="slider-label arabic-text slider-label-2">عربى</div>
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
  <div class="main">
