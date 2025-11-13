<section id="contacto" class="py-5">
  <div class="container">
    <div class="row mb-5">
      <div class="col-12">
        <h2 class="mb-3"><?php echo esc_html__('Contacto', 'mvr-properties-theme'); ?></h2>
        <p class="lead text-muted"><?php echo esc_html__('¿Interesado en una propiedad o tienes preguntas? Escríbenos y te responderemos pronto.', 'mvr-properties-theme'); ?></p>
      </div>
    </div>

    <?php if ($status === 'success') : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo esc_html__('Gracias. Tu mensaje ha sido enviado correctamente.', 'mvr-properties-theme'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php elseif ($status === 'error') : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo esc_html__('Hubo un error al enviar el mensaje. Intenta nuevamente más tarde.', 'mvr-properties-theme'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <div class="row g-4">
      <div class="col-lg-4">
        <h3 class="mb-4"><?php echo esc_html__('Información', 'mvr-properties-theme'); ?></h3>
        <ul class="list-unstyled">
          <li class="mb-3"><strong><?php echo esc_html__('Teléfono:', 'mvr-properties-theme'); ?></strong> <a href="tel:+34123456789">+34 123 456 789</a></li>
          <li class="mb-3"><strong><?php echo esc_html__('Email:', 'mvr-properties-theme'); ?></strong> <a href="mailto:info@ejemplo.com">info@ejemplo.com</a></li>
          <li class="mb-3"><strong><?php echo esc_html__('Dirección:', 'mvr-properties-theme'); ?></strong> Calle Ejemplo 123, Ciudad</li>
        </ul>
      </div>

      <div class="col-lg-8">
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="needs-validation" novalidate>
          <?php
          // Nonce para seguridad
          wp_nonce_field('mvr_contact_action', 'mvr_contact_nonce');
          // Action para admin-post.php
          ?>
          <input type="hidden" name="action" value="mvr_contact_submit" />

          <!-- Honeypot simple para reducir spam -->
          <div style="display:none" aria-hidden="true">
            <label>Leave this empty</label>
            <input type="text" name="mvr_hp" value="" />
          </div>

          <div class="mb-3">
            <label for="mvr_name" class="form-label"><?php echo esc_html__('Nombre', 'mvr-properties-theme'); ?></label>
            <input id="mvr_name" name="mvr_name" type="text" class="form-control" required maxlength="100" />
          </div>

          <div class="mb-3">
            <label for="mvr_email" class="form-label"><?php echo esc_html__('Correo electrónico', 'mvr-properties-theme'); ?></label>
            <input id="mvr_email" name="mvr_email" type="email" class="form-control" required maxlength="100" />
          </div>

          <div class="mb-3">
            <label for="mvr_phone" class="form-label"><?php echo esc_html__('Teléfono (opcional)', 'mvr-properties-theme'); ?></label>
            <input id="mvr_phone" name="mvr_phone" type="tel" class="form-control" maxlength="30" />
          </div>

          <div class="mb-3">
            <label for="mvr_message" class="form-label"><?php echo esc_html__('Mensaje', 'mvr-properties-theme'); ?></label>
            <textarea id="mvr_message" name="mvr_message" class="form-control" rows="6" required maxlength="500"></textarea>
          </div>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg">
              <?php echo esc_html__('Enviar mensaje', 'mvr-properties-theme'); ?>
            </button>
          </div>


          <p class="mt-4 mb-2 text-center text-muted">
            Cuéntame sobre tu proyecto o necesidad (venta, compra, arriendo, etc.):
          </p>


        </form>
      </div>
    </div>
  </div>
  <?php
  // Variables de color para usar en el estilo inline
  $primary = '#54c3cc';
  $dark = '#46494c';
  ?>

  <section class="formulario-contacto py-5" style="background-color: #ffffff;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">

          <div class="text-center mb-4">
            <h2 class="display-6 fw-bold" style="color: <?php echo $dark; ?>;">
              ¿Comenzamos tu proyecto?
            </h2>
            <p class="lead" style="color: <?php echo $secondary; ?>;">
              Contáctame ahora para una consulta gratuita.
            </p>
          </div>

          <div class="p-4 p-md-5 rounded shadow-lg" style="border: 2px solid <?php echo $primary; ?>;">

            <?php
            // REEMPLAZA "35" con el ID REAL de tu Formulario de Contacto 7
            echo do_shortcode('[contact-form-7 id="d42c9a0" title="Formulario Landing Page"]');
            ?>

          </div>
        </div>
      </div>
    </div>
  </section>
</section>