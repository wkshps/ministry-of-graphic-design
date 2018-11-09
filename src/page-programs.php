<?php
/**
 * Template Name: Programs
 */
?>
<?php get_header(); ?>

<?php while ( have_posts() ): the_post(); ?>
  <div class="flipper flipper-content">
    <div class="front-content">
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
        $item_date_prev = null;
      ?>
      <?php if ($the_query->have_posts()): ?>
        <!-- <div class="views">
          <a href="" class="view view-list active">List</a> / <a href="" class="view view-grid">Grid</a>
        </div> -->
        <ul class="schedule">
          <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
            <?php if (get_field('end_date')): ?>
              <?php
                $start_date = new DateTime(get_field('start_date'));
                $end_date = new DateTime(get_field('end_date'));
              ?>
              <?php if ($start_date->format('M') == $end_date->format('M')): ?>
                <?php $item_date = $start_date->format('F j') . '&ndash;' . $end_date->format('j'); ?>
              <?php else: ?>
                <?php $item_date = $start_date->format('F j') . ' &ndash; ' . $end_date->format('F j'); ?>
              <?php endif; ?>
            <?php else: ?>
              <?php
                $start_date = new DateTime(get_field('start_date'));
                $item_date = $start_date->format('F j');
              ?>
            <?php endif; ?>
            <?php if ($item_date != $item_date_prev): ?>
              <div class="schedule-item-date"><?php echo $item_date; ?></div>
            <?php endif; ?>
            <?php $item_date_prev = $item_date; ?>
            <li class="schedule-item">
              <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()): ?>
                  <div class="schedule-item-image">
                    <?php the_post_thumbnail('fikra_third'); ?>
                  </div>
                <?php endif; ?>
                <div class="schedule-item-meta">
                  <?php if (get_field('time')): ?>
                    <div class="schedule-item-time"><?php the_field('time'); ?></div>
                  <?php endif; ?>
                  <?php if (get_field('type')): ?>
                    <div class="schedule-item-type"><?php the_field('type'); ?></div>
                  <?php endif; ?>
                </div>
                <div class="schedule-item-main">
                  <div class="schedule-item-title"><?php the_title(); ?></div>
                  <?php if (get_field('people')): ?>
                    <div class="schedule-item-people"><?php the_field('people'); ?></div>
                  <?php endif; ?>
                </div>
              </a>
            </li>
          <?php endwhile; wp_reset_postdata(); ?>
        </ul>
      <?php endif; ?>
      &nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
    </div>

    <div class="back-content">
      <div class="content arabic-text">
        <?php if (get_the_title() != 'Home' && get_field('arabic_title')): ?>
          <h1 class="page-title <?php if (get_field('start_date')): ?>program-title<?php endif; ?>"><?php the_field('arabic_title'); ?></h1>
        <?php endif; ?>
        <?php the_field('arabic_text'); ?>
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
        <ul class="schedule arabic-text">
          <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
            <?php if (get_field('end_date')): ?>
              <?php
                $start_date = new DateTime(get_field('start_date'));
                $end_date = new DateTime(get_field('end_date'));
              ?>
              <?php if ($start_date->format('M') == $end_date->format('M')): ?>
                <?php $item_date = $start_date->format('F j') . '&ndash;' . $end_date->format('j'); ?>
              <?php else: ?>
                <?php $item_date = $start_date->format('F j') . ' &ndash; ' . $end_date->format('F j'); ?>
              <?php endif; ?>
            <?php else: ?>
              <?php
                $start_date = new DateTime(get_field('start_date'));
                $item_date = $start_date->format('F j');
              ?>
            <?php endif; ?>
            <?php if ($item_date != $item_date_prev): ?>
              <?php if (get_field('arabic_date')): ?>
                <div class="schedule-item-date"><?php the_field('arabic_date'); ?></div>
              <?php else: ?>
                <div class="schedule-item-date"><?php echo $item_date; ?></div>
              <?php endif; ?>
            <?php endif; ?>
            <?php $item_date_prev = $item_date; ?>
            <li class="schedule-item">
              <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()): ?>
                  <div class="schedule-item-image">
                    <?php the_post_thumbnail('fikra_third'); ?>
                  </div>
                <?php endif; ?>
                <div class="schedule-item-meta">
                  <?php if (get_field('arabic_time')): ?>
                    <div class="schedule-item-time"><?php the_field('arabic_time'); ?></div>
                  <?php elseif (get_field('time')): ?>
                    <div class="schedule-item-time"><?php the_field('time'); ?></div>
                  <?php endif; ?>
                  <?php if (get_field('arabic_type')): ?>
                    <div class="schedule-item-type"><?php the_field('arabic_type'); ?></div>
                  <?php elseif (get_field('type')): ?>
                    <div class="schedule-item-type"><?php the_field('type'); ?></div>
                  <?php endif; ?>
                </div>
                <div class="schedule-item-main">
                  <?php if (get_field('arabic_title')): ?>
                    <div class="schedule-item-title"><?php the_field('arabic_title'); ?></div>
                  <?php endif; ?>
                  <?php if (get_field('people')): ?>
                    <div class="schedule-item-people"><?php the_field('people'); ?></div>
                  <?php endif; ?>
                </div>
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
