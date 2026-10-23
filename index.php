<?php get_header(); ?>
<section style="padding:140px 0 80px"><div class="wrap" style="max-width:860px">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <h1><?php the_title(); ?></h1>
  <div class="legal"><?php the_content(); ?></div>
<?php endwhile; else : ?>
  <h1>Page not found</h1><p><a class="link" href="<?php echo esc_url(home_url('/')); ?>">Back to home</a></p>
<?php endif; ?>
</div></section>
<?php get_footer(); ?>
