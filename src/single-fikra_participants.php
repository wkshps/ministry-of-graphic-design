<?php get_header(); ?>

<?php while (have_posts()): the_post(); ?>
  <div class="flipper flipper-content">
    <div class="front-content">
      <div class="content">
        <h1 class="page-title"><?php the_title(); ?></h1>
        <?php the_content(); ?>
        <?php
          $relationships = get_field('relationships', false, false);

          $query = new WP_Query(array(
            'post_type' => 'page',
            'post__in' => $relationships,
            'posts_per_page' => -1
          ));
        ?>

        <?php if ($query->have_posts()): ?>
          <div class="participant-departments section">
            <h2 class="sub-title">Department</h2>
            <?php while ($query->have_posts()): $query->the_post(); ?>
              <?php if (has_post_thumbnail()): ?>
                <div class="department-link"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                  <?php the_post_thumbnail('fikra_half'); ?>
                </a></div>
              <?php endif; ?>
            <?php endwhile; ?>
          </div>
        <?php endif; wp_reset_postdata(); ?>

        <?php
          $query = new WP_Query(array(
            'post_type' => 'fikra_projects',
            'post__in' => $relationships,
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
        <h1><?php the_field('arabic_title'); ?></h1>
        <?php the_field('arabic_text'); ?>

        <?php
          $relationships = get_field('relationships', false, false);

          $query = new WP_Query(array(
            'post_type' => 'page',
            'post__in' => $relationships,
            'posts_per_page' => -1
          ));
        ?>

        <?php if ($query->have_posts()): ?>
          <div class="participant-departments section">
            <h2 class="sub-title">قسم</h2>
            <?php while ($query->have_posts()): $query->the_post(); ?>
              <?php if (has_post_thumbnail()): ?>
                <div class="department-link"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                  <?php the_post_thumbnail('fikra_half'); ?>
                </a></div>
              <?php endif; ?>
            <?php endwhile; ?>
          </div>
        <?php endif; wp_reset_postdata(); ?>

        <?php
          $query = new WP_Query(array(
            'post_type' => 'fikra_projects',
            'post__in' => $relationships,
            'posts_per_page' => -1
          ));
        ?>

        <?php if ($query->have_posts()): ?>
          <div class="department-projects section">
            <h2 class="sub-title">مشاريع</h2>
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
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
