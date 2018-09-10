<?php get_header(); ?>

<?php while (have_posts()): the_post(); ?>
  <div class="slideshow">
    <div class="slide text">
      <header class="slide-header">
        <h1><?php the_title(); ?></h1>
        <div class="slide-featured-image slide-featured-image-<?php echo rand(1, 11); ?>"><?php the_post_thumbnail('workac_fragment'); ?></div>
      </header>
      <div class="slide-text">
        <?php the_content(); ?>

        <?php if (have_rows('credits')): ?>
          <section class="credits">
            <?php while (have_rows('credits')): the_row(); ?>
              <div class="credit">
                <?php if (get_sub_field('credit_title')): ?>
                  <h1 class="credit-title"><?php the_sub_field('credit_title'); ?></h1>
                  <?php if (get_sub_field('credit_text')): ?>
                    <div class="credit-text"><?php the_sub_field('credit_text'); ?></div>
                  <?php endif; ?>
                <?php elseif (get_sub_field('credit_text')): ?>
                  <div class="credit-text no-title"><?php the_sub_field('credit_text'); ?></div>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
          </section>
        <?php endif; ?>
      </div>
    </div>
    <?php if (have_rows('slides')): ?>
      <?php while (have_rows('slides')): the_row(); ?>
        <?php if (get_sub_field('slide') == 'image'): ?>
          <?php $image = get_sub_field('image'); ?>
          <?php if (!empty($image)): ?>
            <?php $thumb = $image['sizes']['workac_full']; ?>
            <?php if (get_sub_field('full_bleed') == true): ?>
              <div class="slide image full-bleed" style="background-image: url(<?php echo $thumb; ?>)">
                <img src="<?php echo $thumb; ?>">
              </div>
            <?php else: ?>
              <div class="slide image">
                <img src="<?php echo $thumb; ?>">
              </div>
            <?php endif; ?>
          <?php endif; ?>
        <?php elseif (get_sub_field('slide') == 'gif'): ?>
          <?php $image = get_sub_field('animated_gif'); ?>
          <?php if (get_sub_field('bleed') == true): ?>
            <div class="slide image" style="background-image: url('<?php echo $image['sizes']['workac_full']; ?>')"></div>
          <?php else: ?>
            <div class="slide image">
              <img src="<?php echo $image['sizes']['workac_full']; ?>">
            </div>
          <?php endif; ?>
        <?php elseif (get_sub_field('slide') == 'video'): ?>
          <div class="slide video">
            <video loop preload muted playsinline>
              <source src="<?php the_sub_field('video'); ?>" type="video/mp4">
            </video>
          </div>
        <?php elseif (get_sub_field('slide') == 'text'): ?>
          <div class="slide text">
            <div class="slide-text">
              <?php the_sub_field('text'); ?>
            </div>
          </div>
        <?php endif; ?>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
