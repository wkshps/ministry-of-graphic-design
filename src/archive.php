<?php get_header(); ?>

<nav class="work-navigation">
  <ul class="categories">
    <?php
      wp_list_categories( array(
        'title_li' => '',
        'hide_empty' => 0
      ));
    ?>
    <li class="cat-item <?php if (is_post_type_archive('workac_work')): ?>current-cat<?php endif; ?>"><a href="/work/">All</a></li>
    <li class="search"><?php get_search_form(); ?></li>
  </ul>
</nav>
<ul class="projects-list">
  <?php while (have_posts()): the_post(); ?>
    <li class="projects-list-item">
      <a href="<?php the_permalink(); ?>">
        <h1 class="projects-list-item-title"><?php the_title(); ?></h1>
        <h2 class="projects-list-item-date"><?php the_field('year'); ?></h2>
      </a>
      <div class="projects-list-item-image projects-list-item-image-<?php echo rand(1, 11); ?>"><?php the_post_thumbnail('workac_fragment'); ?></div>
    </li>
  <?php endwhile; ?>
</ul>

<?php get_footer(); ?>
