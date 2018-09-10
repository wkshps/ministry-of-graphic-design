<!doctype html>
<html <?php language_attributes(); ?> class="loading">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, viewport-fit=cover">
  <meta name="description" content="<?php bloginfo('description'); ?>">
  <meta name="turbolinks-cache-control" content="no-cache">
  <title><?php wp_title('&mdash;', true, 'right'); bloginfo('name'); ?></title>
  <link rel="icon" type="image/x-icon" href="/wp-content/themes/workac/images/favicon.png">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php get_template_part('svg-defs'); ?>
  <header class="site-header">
    <nav class="site-header-nav">
      <ul>
        <li class="site-header-nav-work"><a href="/category/architecture/">Work</a></li>
        <li class="site-header-nav-home"><a href="<?php if (is_front_page()): ?>/featured/<?php else: ?>/<?php endif; ?>">WORK<span class="small"></span></a></li>
        <li class="site-header-nav-about"><a href="/about/">About</a></li>
      </ul>
    </nav>
  </header>
  <div class="main">
