<?php get_header(); ?>

<div class="flipper flipper-content">
  <?php
    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'fikra_participants',
      'orderby' => 'meta_value',
      'meta_key' => 'surname',
      'order' => 'ASC'
    );
    $the_query = new WP_Query($args);
  ?>
  <div class="front-content">
    <div class="content">
      <h1 class="page-title">Participants</h1>
      <div class="participants-list">
        <?php if ($the_query->have_posts()): ?>
          <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
            <div class="participants-list-item">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php wp_reset_query(); ?>
  <?php
    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'fikra_participants',
      'orderby' => 'meta_value',
      'meta_key' => 'surname_arabic',
      'order' => 'ASC'
    );
    $the_query = new WP_Query($args);
  ?>
  <div class="back-content">
    <div class="content arabic-text">
      <div class="participants-list">
        <?php if ($the_query->have_posts()): ?>
          <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
            <div class="participants-list-item">
              <a href="<?php the_permalink(); ?>"><?php the_field('arabic_title'); ?></a>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
