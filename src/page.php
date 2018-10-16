<?php get_header(); ?>

<?php while ( have_posts() ): the_post(); ?>
  <div class="flipper flipper-content">
    <div class="front-content">
      <div class="content">
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
        <?php the_content(); ?>
        &nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
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
        &nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
      </div>
    </div>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>
