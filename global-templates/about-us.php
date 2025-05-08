<?php

/**
 * About us setup
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (is_active_sidebar('hero') || is_active_sidebar('statichero') || is_active_sidebar('herocanvas')) :
?>

	<div class="wrapper" id="wrapper-about-us">
		<div class="container mb-5">
			<div class="d-flex mb-5 pb-3">
				<div class="mx-auto">
					<h2 class="title-underline">¿Quiénes somos?</h2>
				</div>
			</div>

			<div class="row justify-content-md-center mb-4 pb-4">
				<div class="col-5">
					<div class="border rounded px-3 py-5">
						<p class="text-center"><i class="bi bi-house display-4 text-primary"></i></p>
						<!-- <p class="text-center fw-semibold">¿Quién Soy? </p> -->
						<p class="ps-3"><span class="fw-semibold">¿Quién Soy?</span> Soy una apasionada corredora de propiedades con una sólida formación en corretaje inmobiliario y marketing, lo que me permite ofrecerte una asesoría integral en cada paso de la compra, venta o arriendo de inmuebles. <br> Junto a mi equipo, nuetro objetivo es entender tus necesidades y convertir tus sueños en realidad.</p>
					</div>
				</div>
				<div class="col-5 ">
					<div class="border rounded  py-2">
						<p class="text-center"><i class="bi bi-map display-5 text-primary"></i></p>
						<p class="ps-3"><span class="fw-semibold">Mi Filosofía</span> En MVR Propiedades, creemos que cada propiedad tiene una historia y cada cliente, un sueño. <br> Nos dedicamos a ofrecer soluciones inmobiliarias que se adapten a tus necesidades específicas, asegurándonos de que cada transacción sea transparente, segura y exitosa. </p>
					</div>
				</div>
			</div>
			<div class="row justify-content-lg-center align-items-md-center ">
				<div class="col-md-4 mb-10 mb-md-0 ">
					<div class="position-relative">
						<img class="img-fluid rounded-2" src="http://localhost/wp-content/uploads/2025/01/mvr-propiedades.webp" style="height: 450px;" alt="Image Description">
						<div class=" position-absolute bottom-0 start-0 zi-n1 mb-n7 ms-n7" style="width: 12rem;">
							<img class="img-fluid" src="http://localhost/wp-content/uploads/2025/01/dots-lg.svg" alt="Image Description">
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="ps-md-5">
						<figure class="">
							<blockquote class="blockquote">
								<p class="fst-italic"> <i class="bi bi-quote"></i>¡Hola! Soy María Verónica Rojas, <br> tu asesora confiable en el mundo inmobiliario de la Quinta región. Lidero MVR Propiedades con el compromiso de brindarte un servicio personalizado y de alta calidad.<i class="bi bi-quote inverted-text"></i></p>
							</blockquote>
							<figcaption class="blockquote-footer">
								Someone famous in <cite title="Source Title">Source Title</cite>
							</figcaption>
						</figure>

						<!-- <button type="button" class="btn btn-success rounded wsp-button">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
								<path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"></path>
							</svg>
						</button> -->
						<div class="wsp-button">
							<a class="" href="https://api.whatsapp.com/send?phone=56988886147" target="_blank" rel="noopener noreferrer">
								<img src="http://localhost/wp-content/uploads/2025/01/whatsapp.png" alt="" style="height: 3.125rem;">
							</a>
						</div>

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
