<?php

/**
 * Template Name: Landing Page
 *
 * @package Understrap
 */

get_header();
?>

<div class="wrapper" id="page-wrapper">
  <div class="container" id="content" tabindex="-1">
    <main class="site-main" id="main">

      <section class="hero text-center p-5 mb-4 bg-light">
        <h1>Bienvenido a Nuestra Corredora</h1>
        <p>Las mejores propiedades a tu alcance.</p>
      </section>

      <section class="propiedades-destacadas">
        <h2 class="text-center mb-4">Propiedades Destacadas</h2>
        <div class="row">

          <?php
          $args = array(
            'post_type'      => 'propiedad', // Buscamos en nuestro CPT
            'posts_per_page' => 3,           // Solo 3
            'orderby'        => 'date',
            'order'          => 'DESC',
          );
          $query_propiedades = new WP_Query($args);

          if ($query_propiedades->have_posts()) :
            while ($query_propiedades->have_posts()) : $query_propiedades->the_post();
          ?>

              <div class="col-md-4 mb-4">
                <div class="card">
                  <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>">
                      <?php the_post_thumbnail('large', array('class' => 'card-img-top')); ?>
                    </a>
                  <?php endif; ?>
                  <div class="card-body">
                    <h5 class="card-title"><?php the_title(); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php the_field('ubicacion'); // Campo de ACF 
                                                              ?></h6>
                    <p class="card-text">
                      <strong>Precio:</strong> $<?php echo number_format(get_field('precio')); ?><br>
                      <strong>Habitaciones:</strong> <?php the_field('habitaciones'); ?> | <strong>Baños:</strong> <?php the_field('banos'); ?>
                    </p>
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Ver Detalles</a>
                  </div>
                </div>
              </div>


          <?php
            endwhile;
            wp_reset_postdata(); // Limpiamos la consulta
          endif;
          ?>
        </div>
      </section>

    </main>
  </div>
</div>

<?php get_footer(); ?>