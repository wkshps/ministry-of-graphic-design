<?php
/**
 * Template Name: Departments
 */
?>
<?php get_header(); ?>

<?php

$args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $post->ID,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
);
$parent = new WP_Query( $args );

if ( $parent->have_posts() ) : ?>
<div class="flipper flipper-content">
  <div class="front-content">
    <div class="content departments">
      <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
        <div id="page-<?php the_ID(); ?>" class="department-teaser">
          <?php if (has_post_thumbnail()): ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
              <?php the_post_thumbnail('fikra_half'); ?>
            </a>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
  <div class="back-content">
    <div class="content arabic-text departments">
      <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
        <div id="page-<?php the_ID(); ?>" class="department-teaser">
          <?php if (has_post_thumbnail()): ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
              <?php the_post_thumbnail('fikra_half'); ?>
            </a>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
<?php endif; wp_reset_postdata(); ?>

<?php get_footer(); ?>
