<div class="wrapper" id="wrapper-footer" style="background-color: <?php echo $dark; ?>; color: <?php echo $light; ?>;">

	<div class="container py-5">
		<div class="row">

			<div class="col-md-3 mb-4">
				<h4 class="mb-4" style="color: <?php echo $primary; ?>;">Contáctanos</h4>
				<ul class="list-unstyled">
					<li class="mb-2"><i class="bi bi-geo-alt-fill me-2"></i> Av. Libertad 1234, Viña del Mar</li>
					<li class="mb-2"><i class="bi bi-telephone-fill me-2"></i> +56 9 1234 5678</li>
					<li class="mb-2"><i class="bi bi-envelope-fill me-2"></i> <a href="mailto:contacto@tucorredora.cl" style="color: <?php echo $light; ?>;">contacto@tucorredora.cl</a></li>
				</ul>
			</div>

			<div class="col-md-3 mb-4">
				<br>
				<?php
				wp_nav_menu(array(
					'theme_location' => 'footer-menu-rapido', // Crea esta ubicación en functions.php si no existe
					'container'      => false,
					'menu_class'     => 'list-unstyled',
					'fallback_cb'    => false,
				));
				?>
			</div>

			<div class="col-md-3 mb-4">
				<h4 class="mb-4" style="color: <?php echo $primary; ?>;">Legal</h4>
				<?php
				wp_nav_menu(array(
					'theme_location' => 'footer-menu-legal', // Crea esta ubicación en functions.php si no existe
					'container'      => false,
					'menu_class'     => 'list-unstyled',
					'fallback_cb'    => false,
				));
				?>
			</div>

			<div class="col-md-3 mb-4 text-end">
				<h4 class="mb-4" style="color: <?php echo $primary; ?>;">Síguenos</h4>
				<div class="social-icons">
					<a href="URL_FACEBOOK" class="me-3" style="color: <?php echo $light; ?>;"><i class="bi bi-facebook" style="font-size: 1.8rem;"></i></a>
					<a href="URL_INSTAGRAM" class="me-3" style="color: <?php echo $light; ?>;"><i class="bi bi-instagram" style="font-size: 1.8rem;"></i></a>
					<a href="URL_LINKEDIN" style="color: <?php echo $light; ?>;"><i class="bi bi-linkedin" style="font-size: 1.8rem;"></i></a>
				</div>
			</div>

		</div>
	</div>

	<div class="container" id="colophon">
		<div class="row">
			<div class="col-12 py-3 border-top border-white border-opacity-25">
				<p class="text-center small mb-0" style="color: <?php echo $secondary; ?>;">
					&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.
				</p>
			</div>
		</div>
	</div>

</div>