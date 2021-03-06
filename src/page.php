<?php get_header(); ?>

<?php while ( have_posts() ): the_post(); ?>
  <div class="flipper flipper-content">
    <div class="front-content">
      <div class="content">
        <?php if (get_field('type')): ?>
          <div class="program-type"><?php the_field('type'); ?></div>
        <?php endif; ?>
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
          <?php $start_date = new DateTime(get_field('start_date')); ?>
          <div class="program-date"><?php echo $start_date->format('M j'); ?></div>
        <?php endif; ?>
        <?php if (get_field('time')): ?>
          <div class="program-time"><?php the_field('time'); ?></div>
        <?php endif; ?>
        <?php if (get_the_title() != 'Home'): ?>
          <h1 class="page-title <?php if (get_field('start_date')): ?>program-title<?php endif; ?>"><?php the_title(); ?></h1>
        <?php endif; ?>
        <?php if (get_field('people')): ?>
          <div class="program-people"><?php the_field('people'); ?></div>
        <?php endif; ?>
        <?php the_content(); ?>
        <?php if (get_the_title() == 'Home'): ?><p class="credit">Graphic identity &amp; website by Eric Price &amp; Chris Wu at <a href="http://www.wkshps.com/">Wkshps</a></p><?php endif; ?>

        <?php
          $relationships = get_field('relationships', false, false);

          $query = new WP_Query(array(
            'post_type' => 'fikra_participants',
            'post__in' => $relationships,
            'meta_key' => 'surname',
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'posts_per_page' => -1
          ));
        ?>

        <?php if ($query->have_posts()): ?>
          <div class="department-participants section">
            <h2 class="sub-title">Participants</h2>
            <?php while ($query->have_posts()): $query->the_post(); ?>
              <div class="participant"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
            <?php endwhile; ?>
          </div>
        <?php endif; wp_reset_postdata(); ?>

        <?php
          $query = new WP_Query(array(
            'post_type' => 'fikra_projects',
            'post__in' => $relationships,
            'orderby' => 'title',
            'order' => 'ASC',
            'posts_per_page' => -1
          ));
        ?>

        <?php if ($query->have_posts()): ?>
          <div class="department-projects section">
            <h2 class="sub-title">Projects</h2>
            <div class="grid">
              <div class="gutter-sizer"></div>
              <?php while ($query->have_posts()): $query->the_post(); ?>
                <div class="project grid-item">
                  <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()): ?>
                      <div class="grid-item-image">
                        <?php add_filter( 'wp_calculate_image_srcset_meta', '__return_null' ); the_post_thumbnail('fikra_half'); remove_filter( 'wp_calculate_image_srcset_meta', '__return_null' ); ?>
                      </div>
                    <?php endif; ?>
                    <div class="title"><?php the_title(); ?></div>
                  </a>
                </div>
              <?php endwhile; ?>
            </div>
          </div>
        <?php endif; wp_reset_postdata(); ?>

        &nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
      </div>
    </div>

    <div class="back-content">
      <div class="content arabic-text">
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
          <div class="program-time"><?php the_field('time_arabic'); ?></div>
        <?php endif; ?>
        <?php if (get_the_title() != 'Home' && get_field('arabic_title')): ?>
          <h1 class="page-title <?php if (get_field('start_date')): ?>program-title<?php endif; ?>"><?php the_field('arabic_title'); ?></h1>
        <?php endif; ?>
        <?php the_field('arabic_text'); ?>
        &nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
      </div>

      <?php if( get_field('relationships') ): ?>
        <?php
          $relationship_ids = get_field('relationships', false, false);

          $related = new WP_Query(array(
            'post_type' => array('page', 'tribe_events'),
            'posts_per_page' => -1,
            'post__in' => $relationship_ids,
            'order' => 'ASC',
            'orderby' => 'menu_order'
          ));

          $i = 1;
        ?>
        <?php if ( $related->have_posts() ): ?>
          <section class="clear">
            <h1 class="loud indented">Related</h1>
            <div class="features features-slideshow grid">
              <div class="features-group">
                <?php while ( $related->have_posts() ): $related->the_post(); ?>
                  <div class="features-item features-item-third">
                    <a href="<?php the_permalink(); ?>">
                      <div class="features-item-image">
                        <?php the_post_thumbnail('front_third'); ?>
                      </div>
                      <h1 class="features-item-title"><?php the_title(); ?></h1>
                    </a>
                  </div>
                  <?php if( $i % 3 == 0 ) { echo '</div><div class="features-group">'; } $i++; ?>
                <?php endwhile; ?>
              </div>
            </div>
          </section>
        <?php endif; wp_reset_query(); ?>
      <?php endif; ?>
    </div>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
