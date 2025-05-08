<?php

/**
 * Hero setup
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (is_active_sidebar('hero') || is_active_sidebar('statichero') || is_active_sidebar('herocanvas')) :
?>

	<div class="wrapper" id="wrapper-hero">
		<div class="container mb-5">
			<div class="row ">
				<div class="col">
					<div class="mt-5">
						<h1 class="display-4">Vende tu propiedad </h1>
						<h2 class="display-4">de forma sencilla </h2>
						<h6 class="display-6"> <em>y sin complicaciones</em></h6>
						<br>
						<p>Te brindamos el apoyo que necesitas en cada paso</p>
						<div class="card shadow-lg p-3 mb-5 bg-body rounded border-0">
							<form>
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<input type="text" name="name" class="form-control form-control-sm" placeholder="Nombre">
										</div>
									</div>
									<div class="col">
										<div class="mb-3">
											<input type="text" name="name" class="form-control form-control-sm" placeholder="Apellido">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<input type="text" name="phone" class="form-control form-control-sm " placeholder="Teléfono">
										</div>
									</div>
									<div class="col">
										<div class="mb-3">
											<input type="email" name="email" class="form-control form-control-sm" placeholder="email@gmail.com">
										</div>
									</div>
								</div>
								<div class="">
									<div class="mb-3">
										<textarea class="form-control" name="message" rows="2" placeholder="Mensaje"></textarea>
									</div>
								</div>
								<div class="d-grid gap-2">
									<button type="submit" class="btn btn-primary">Contáctanos ahora</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col position-relative">
					<img src="http://localhost/wp-content/uploads/2025/01/hero-scaled.webp" alt="" class="fluid">
					<div class="position-absolute top-0 start-0">

					</div>
				</div>
			</div>
		</div>
		<?php
		get_template_part('sidebar-templates/sidebar', 'hero');
		get_template_part('sidebar-templates/sidebar', 'herocanvas');
		get_template_part('sidebar-templates/sidebar', 'statichero');
		?>

	</div>

<?php
endif;
