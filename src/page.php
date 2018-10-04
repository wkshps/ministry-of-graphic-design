<?php get_header(); ?>

<?php while ( have_posts() ): the_post(); ?>
  <div class="flipper flipper-content">
    <div class="front-content">
      <header class="site-header">
        <?php if (get_the_title() != 'Home'): ?><a href="/" class="home-link"><?php endif; ?>
          <h1 class="arabic-text">بينالي فكرة للتصميم الجرافيكي</h1>
          <h1>Fikra Graphic Design Biennial 01</h1>
          <p>November 9&ndash;30</p>
          <p class="spaced">* * *</p>
          <p class="arabic-text">الإمارات العربية المتحدة، الشارقة</p>
          <p><span class="spaced">Sharjah, UAE</span> <span class="spaced">1st edition</span> <span class="spaced">2018</span></p>
          <p>--------------</p>
        <?php if (get_the_title() != 'Home'): ?></a><?php endif; ?>
        <nav class="site-nav">
          <?php
            wp_nav_menu(array(
              'theme_location' => 'main-menu',
              'container' => null,
              'item_spacing' => 'discard'
            ));
          ?>
        </nav>
      </header>

      <div class="content">
        <?php if (get_field('end_date')): ?>
          <?php
            $start_date = new DateTime(get_field('start_date'));
            $end_date = new DateTime(get_field('end_date'));
          ?>
          <?php if ($start_date->format('M') == $end_date->format('M')): ?>
            <div class="program-date"><?php echo $start_date->format('F j'); ?>&ndash;<?php echo $end_date->format('j'); ?></div>
          <?php else: ?>
            <div class="program-date"><?php echo $start_date->format('F j'); ?> &ndash; <?php echo $end_date->format('F j'); ?></div>
          <?php endif; ?>
        <?php elseif (get_field('start_date')): ?>
          <div class="program-date"><?php echo $start_date->format('M j'); ?></div>
        <?php endif; ?>
        <?php if (get_field('time')): ?>
          <div class="program-time"><?php the_field('time'); ?></div>
        <?php endif; ?>
        <?php if (get_the_title() != 'Home'): ?>
          <h1 class="page-title <?php if (get_field('start_date')): ?>program-title<?php endif; ?>"><?php the_title(); ?></h1>
        <?php endif; ?>
        <?php the_content(); ?>
        &nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
      </div>
    </div>

    <div class="back-content">
      <header class="site-header">
        <h1 class="arabic-text">بينالي فكرة للتصميم الجرافيكي</h1>
        <h1>Fikra Graphic Design Biennial 01</h1>
        <p>November 9&ndash;30</p>
        <p class="spaced">* * *</p>
        <p class="arabic-text">الإمارات العربية المتحدة، الشارقة</p>
        <p><span class="spaced">Sharjah, UAE</span> <span class="spaced">1st edition</span> <span class="spaced">2018</span></p>
        <p>--------------</p>
      </header>

      <div class="content">
        <?php the_field('arabic_text'); ?>
        &nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
      </div>
    </div>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
