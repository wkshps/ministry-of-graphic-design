<?php get_header(); ?>

<?php while (have_posts()): the_post(); ?>
  <div class="flipper flipper-content">
    <div class="front-content">
      <div class="content">
        <h1 class="page-title"><?php the_title(); ?></h1>
        <?php the_content(); ?>
      </div>
    </div>
    <div class="back-content">
      <div class="content">
        <h1 class="page-title"><?php the_title(); ?></h1>
        <?php the_content(); ?>
      </div>
    </div>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
