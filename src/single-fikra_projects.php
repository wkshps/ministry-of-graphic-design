<?php get_header(); ?>

<?php while (have_posts()): the_post(); ?>
  <div class="flipper flipper-content">
    <div class="front-content">
      <div class="content">
        <h2><?php the_field('tombstone'); ?></h2>
        <?php $images = get_field('gallery'); ?>
        <?php if ($images): ?>
          <div class="slideshow">
            <?php foreach ($images as $image): ?>
              <div class="slide">
                <img src="<?php echo $image['sizes']['fikra_full']; ?>">
                <p class="caption"><?php echo $image['caption']; ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
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

        &nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
      </div>
    </div>
    <div class="back-content">
      <div class="content">
        <h2><?php the_field('tombstone_arabic'); ?></h2>
        <?php $images = get_field('gallery_arabic'); ?>
        <?php if ($images): ?>
          <div class="slideshow">
            <?php foreach ($images as $image): ?>
              <div class="slide">
                <img src="<?php echo $image['sizes']['fikra_full']; ?>">
                <p class="caption"><?php echo $image['caption']; ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        <?php the_field('arabic_text'); ?>

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

        &nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
      </div>
    </div>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
