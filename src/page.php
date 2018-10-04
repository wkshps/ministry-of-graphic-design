<?php get_header(); ?>

<?php while ( have_posts() ): the_post(); ?>
<div class="flipper flipper-content">
  <div class="front-content">
    <header class="site-header">
      <h1 class="arabic-text">بينالي فكرة للتصميم الجرافيكي</h1>
      <h1>Fikra Graphic Design Biennial 01</h1>
      <p>November 9&ndash;30</p>
      <p class="spaced">* * *</p>
      <p class="arabic-text">الإمارات العربية المتحدة، الشارقة</p>
      <p><span class="spaced">Sharjah, UAE</span> <span class="spaced">1st edition</span> <span class="spaced">2018</span></p>
      <p>--------------</p>
    </header>

    <div class="content">
      <?php the_content(); ?>
      &nbsp;
    </div>
  </div>

  <div class="back-content">
    <header class="site-header">
      <h1 class="arabic-text">بينالي فكرة للتصميم الجرافيكي</h1>
      <h1>Fikra Graphic Design Biennial 01</h1>
      <p>November 9&ndash;30</p>
      <p class="spaced">* * *</p>
      <p class="arabic-text">الإمارات العربية المتحدة، الشارقة</p>
      <p><span class="spaced">Sharjah, UAE</span> <span class="spaced">1st edition</span> <span class="spaced">2018</span></p>
      <p>--------------</p>
    </header>

    <div class="content">
      <?php the_field('arabic_text'); ?>
&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
    </div>
  </div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>
