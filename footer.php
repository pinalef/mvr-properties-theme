<?php
// Código para el botón de WhatsApp
$numero_wsp = '56988886147'; // Ejemplo: +56 9 1234 5678 (Sin signos + ni espacios)
$mensaje_wsp = urlencode("¡Hola! Estoy interesado/a en una de sus propiedades. ¿Podrían darme más detalles o coordinar una visita? ¡Gracias!");
$facebook_url = 'https://www.facebook.com/profile.php?id=61550118880875'; // Reemplaza con la URL de tu página de Facebook
$instagram_url = 'https://www.instagram.com/mvr_propiedades/'; // Reemplaza con la URL de tu perfil de Instagram
$linkedin_url = 'https://www.linkedin.com/in/mvr-propiedades-524b62227/'; // Reemplaza con la URL de tu perfil de LinkedIn
?>

<a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($numero_wsp); ?>&text=<?php echo esc_attr($mensaje_wsp); ?>"
	class="wsp-button"
	target="_blank"
	rel="noopener noreferrer"
	title="Contáctanos por WhatsApp">

	<i class="bi bi-whatsapp"></i>
</a>
<div class="wrapper bg-dark text-white" id="wrapper-footer">

	<div class="container py-5">
		<div class="row">

			<div class="col-md-3 mb-4">
				<h4 class="mb-4" style="color: <?php echo $primary; ?>;">Contáctanos</h4>
				<ul class="list-unstyled">
					<li class="mb-2"><i class="bi bi-geo-alt-fill me-2"></i> San Martin 1555, Viña del Mar</li>
					<li class="mb-2"><i class="bi bi-telephone-fill me-2"></i> +56 9 9 8888 6147</li>
					<li class="mb-2"><i class="bi bi-envelope-fill me-2"></i> <a href="mailto:mvr.propiedades7@gmail.com" style="color: <?php echo $light; ?>;">mvr.propiedades7@gmail.com</a></li>
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
					<a href="<?php echo esc_attr($facebook_url); ?>" class="me-3" style="color: <?php echo $light; ?>;"><i class="bi bi-facebook" style="font-size: 1.8rem;"></i></a>
					<a href="<?php echo esc_attr($instagram_url); ?>" class="me-3" style="color: <?php echo $light; ?>;"><i class="bi bi-instagram" style="font-size: 1.8rem;"></i></a>
					<a href="<?php echo esc_attr($linkedin_url); ?>" style="color: <?php echo $light; ?>;"><i class="bi bi-linkedin" style="font-size: 1.8rem;"></i></a>
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