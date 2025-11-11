<?php


get_header();
?>

<div class="wrapper" id="single-wrapper">

  <div class="container" id="content" tabindex="-1">

    <div class="row">

      <div class="col-md-8">

        <main class="site-main" id="main">

          <?php while (have_posts()) : the_post(); ?>

            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

              <header class="entry-header mb-4">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                <div class="entry-meta" style="font-size: 1.2rem; color: #555;">
                  <span>
                    <?php echo get_the_term_list($post->ID, 'tipo_propiedad', '', ', ', ''); ?>
                    en
                    <?php echo get_the_term_list($post->ID, 'tipo_operacion', '', ', ', ''); ?>
                  </span>
                  <br>
                  <span class="text-muted">
                    <i class="bi bi-geo-alt-fill"></i>
                    <?php echo get_the_term_list($post->ID, 'comuna', '', ', ', ''); ?>
                  </span>
                </div>
              </header>

              <?php
              // Se asume que 'galeria_propiedad' es un campo ACF Relationship que devuelve IDs.
              $galeria = get_field('galeria_propiedad');
              if ($galeria) :
              ?>
                <div id="galeriaPropiedad" class="carousel slide mb-4" data-bs-ride="carousel">
                  <div class="carousel-inner">
                    <?php $i = 0;
                    foreach ($galeria as $imagen_id) : // $imagen_id es el ID de la imagen 
                    ?>
                      <div class="carousel-item <?php if ($i == 0) echo 'active'; ?>">
                        <img src="<?php echo esc_url(wp_get_attachment_image_url($imagen_id, 'large')); ?>"
                          class="d-block w-100 rounded"
                          alt="<?php echo esc_attr(get_post_meta($imagen_id, '_wp_attachment_image_alt', true)); ?>">
                      </div>
                    <?php $i++;
                    endforeach; ?>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#galeriaPropiedad" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#galeriaPropiedad" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                  </button>
                </div>
              <?php endif; ?>

              <div class="entry-content">
                <h3>Descripción</h3>
                <?php the_content(); ?>
              </div>

              <div class="ficha-tecnica my-4 p-3 border rounded bg-light">
                <h3 class="mb-3 border-bottom pb-2">Ficha Técnica</h3>
                <ul class="list-unstyled row">
                  <?php if (get_field('dormitorios')): ?>
                    <li class="col-md-6 mb-2"><strong>Dormitorios:</strong> <?php the_field('dormitorios'); ?></li>
                  <?php endif; ?>
                  <?php if (get_field('banos')): ?>
                    <li class="col-md-6 mb-2"><strong>Baños:</strong> <?php the_field('banos'); ?></li>
                  <?php endif; ?>
                  <?php if (get_field('superficie')): ?>
                    <li class="col-md-6 mb-2"><strong>Superficie:</strong> <?php the_field('superficie'); ?> m²</li>
                  <?php endif; ?>
                </ul>

                <?php
                $pdf = get_field('pdf_tasacion');
                if ($pdf) : ?>
                  <a href="<?php echo esc_url($pdf); ?>" target="_blank" class="btn btn-outline-danger mt-3">
                    <i class="bi bi-file-earmark-pdf-fill"></i> Descargar PDF de Tasación
                  </a>
                <?php endif; ?>
              </div>

            </article>

          <?php endwhile; // end of the loop. 
          ?>

        </main>

      </div>

      <div class="col-md-4">
        <aside class="widget-area" id="secondary" role="complementary">

          <div class="card p-3 shadow-sm" style="position: sticky; top: 20px;">

            <?php if (get_field('precio')): ?>
              <div class="precio-widget text-center mb-4 border-bottom pb-3">
                <h4 class="mb-0 text-muted">Precio de <?php echo strip_tags(get_the_term_list($post->ID, 'tipo_operacion', '', ', ', '')); ?></h4>
                <span class="display-6 fw-bold text-primary">$<?php echo number_format(get_field('precio'), 0, ',', '.'); ?></span>
              </div>
            <?php endif; ?>

            <h5 class="text-center">¡Me interesa esta Propiedad!</h5>
            <p class="text-center small text-muted">Déjanos tus datos y te contactaremos a la brevedad.</p>

            <?php
            // ASEGÚRATE DE REEMPLAZAR TU_ID_DE_FORMULARIO con el número real.
            echo do_shortcode('[contact-form-7 id="TU_ID_DE_FORMULARIO" title="Formulario Propiedad"]');
            ?>
          </div>

        </aside>
      </div>

    </div>
  </div>
</div><?php get_footer(); ?>