<?php


get_header();

while ( have_posts() ) :
	the_post();

  $subhero_text = get_field('subhero_text');
	?>

<main id="content" <?php post_class( 'site-main' ); ?> role="main">

	<?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
		<header class="sub-hero">
      <a class="breadcrumps" href="">Breadcrumps</a>
      <h1><?php the_title(); ?></h1>
      <p><?php echo $subhero_text; ?></p>
		</header>
	<?php endif; ?>

	<div class="page-content">
		<?php the_content(); ?>
  </div>

</main>

<?php endwhile; ?>

page.php here -- with Template predefinito

<?php get_footer(); ?>