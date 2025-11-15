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
                <!-- 1. SWIPER PRINCIPAL (IMAGEN GRANDE) -->
                <div class="swiper swiper-main mb-3" id="swiper-main">
                  <div class="swiper-wrapper">
                    <?php foreach ($galeria as $imagen_id) : ?>
                      <div class="swiper-slide">
                        <img
                          src="<?php echo esc_url(wp_get_attachment_image_url($imagen_id, 'large')); ?>"
                          srcset="<?php echo esc_attr(wp_get_attachment_image_srcset($imagen_id, 'large')); ?>"
                          sizes="(max-width: 768px) 100vw, 800px"
                          class="d-block w-100 rounded-lg shadow-md object-cover"
                          style="aspect-ratio: 16/9; height: auto;"
                          alt="<?php echo esc_attr(get_post_meta($imagen_id, '_wp_attachment_image_alt', true)); ?>">
                      </div>
                    <?php endforeach; ?>
                  </div>

                  <!-- Botones de navegación -->
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>

                  <!-- Paginación (opcional) -->
                  <!-- <div class="swiper-pagination"></div> -->
                </div>

                <!-- 2. SWIPER MINIATURAS (THUMBS) -->
                <div class="swiper swiper-thumbs" id="swiper-thumbs">
                  <div class="swiper-wrapper">
                    <?php foreach ($galeria as $imagen_id) : ?>
                      <div class="swiper-slide">
                        <!-- Usamos el tamaño 'thumbnail' para las miniaturas -->
                        <img
                          src="<?php echo esc_url(wp_get_attachment_image_url($imagen_id, 'thumbnail')); ?>"
                          class="d-block w-100 rounded-sm cursor-pointer opacity-75 hover:opacity-100 transition-opacity"
                          style="aspect-ratio: 1/1; height: 100px; object-fit: cover;"
                          alt="Miniatura de la propiedad">
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>

              <?php endif; ?>
              <p>----------------------------</p>
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
<?php wp_footer(); ?>