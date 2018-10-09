<?php
/**
 * Template Name: Programs
 */
?>
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
        <?php if (get_the_title() != 'Home'): ?>
          <h1 class="page-title"><?php the_title(); ?></h1>
        <?php endif; ?>
        <?php the_content(); ?>
      </div>
      <?php
        $args = array(
          'posts_per_page' => -1,
          'post_type' => 'page',
          'post_parent' => $post->ID,
          'orderby' => 'meta_value',
          'meta_key' => 'start_date',
          'order' => 'ASC'
        );

        $the_query = new WP_Query($args);
      ?>
      <?php if ($the_query->have_posts()): ?>
        <div class="views">
          <a href="" class="view view-list active">List</a> / <a href="" class="view view-grid">Grid</a>
        </div>
        <ul class="schedule">
          <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
            <li class="schedule-item">
              <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()): ?>
                  <div class="schedule-item-image">
                    <?php the_post_thumbnail('fikra_third'); ?>
                  </div>
                <?php endif; ?>
                <?php if (get_field('end_date')): ?>
                  <?php
                    $start_date = new DateTime(get_field('start_date'));
                    $end_date = new DateTime(get_field('end_date'));
                  ?>
                  <?php if ($start_date->format('M') == $end_date->format('M')): ?>
                    <div class="schedule-item-date"><?php echo $start_date->format('M j'); ?>&ndash;<?php echo $end_date->format('j'); ?></div>
                  <?php else: ?>
                    <div class="schedule-item-date"><?php echo $start_date->format('M j'); ?> &ndash; <?php echo $end_date->format('M j'); ?></div>
                  <?php endif; ?>
                <?php else: ?>
                  <div class="schedule-item-date"><?php echo $start_date->format('M j'); ?></div>
                <?php endif; ?>
                <?php if (get_field('time')): ?>
                  <div class="schedule-item-time"><?php the_field('time'); ?></div>
                <?php endif; ?>
                <div class="schedule-item-title"><?php the_title(); ?></div>
              </a>
            </li>
          <?php endwhile; wp_reset_postdata(); ?>
        </ul>
      <?php endif; ?>
      &nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
    </div>

    <div class="back-content">
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

      <?php
        $args = array(
          'posts_per_page' => -1,
          'post_type' => 'page',
          'post_parent' => $post->ID,
          'orderby' => 'meta_value',
          'meta_key' => 'start_date',
          'order' => 'ASC'
        );

        $the_query = new WP_Query($args);
      ?>
      <?php if ($the_query->have_posts()): ?>
        <div class="views">
          <a href="" class="view view-list active">List</a> / <a href="" class="view view-grid">Grid</a>
        </div>
        <ul class="schedule">
          <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
            <li class="schedule-item">
              <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()): ?>
                  <div class="schedule-item-image">
                    <?php the_post_thumbnail('fikra_third'); ?>
                  </div>
                <?php endif; ?>
                <?php if (get_field('end_date')): ?>
                  <?php
                    $start_date = new DateTime(get_field('start_date'));
                    $end_date = new DateTime(get_field('end_date'));
                  ?>
                  <?php if ($start_date->format('M') == $end_date->format('M')): ?>
                    <div class="schedule-item-date"><?php echo $start_date->format('M j'); ?>&ndash;<?php echo $end_date->format('j'); ?></div>
                  <?php else: ?>
                    <div class="schedule-item-date"><?php echo $start_date->format('M j'); ?> &ndash; <?php echo $end_date->format('M j'); ?></div>
                  <?php endif; ?>
                <?php else: ?>
                  <div class="schedule-item-date"><?php echo $start_date->format('M j'); ?></div>
                <?php endif; ?>
                <?php if (get_field('time')): ?>
                  <div class="schedule-item-time"><?php the_field('time'); ?></div>
                <?php endif; ?>
                <div class="schedule-item-title"><?php the_title(); ?></div>
              </a>
            </li>
          <?php endwhile; wp_reset_postdata(); ?>
        </ul>
      <?php endif; ?>
      &nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
    </div>
    </div>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
