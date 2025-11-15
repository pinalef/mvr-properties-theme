/**
 * Inicialización de Swiper para la Galería de Propiedades.
 * Sigue el patrón 'Gallery with Thumbs'.
 */
document.addEventListener("DOMContentLoaded", function () {
	// Si los contenedores no existen, salimos.
	if (
		!document.getElementById("swiper-main") ||
		!document.getElementById("swiper-thumbs")
	) {
		return;
	}

	// 1. Inicializar Swiper de Miniaturas (Thumbs)
	const galleryThumbs = new Swiper("#swiper-thumbs", {
		spaceBetween: 10,
		slidesPerView: 4, // Muestra 4 miniaturas a la vez
		freeMode: true,
		watchSlidesProgress: true, // Crucial para la sincronización
		breakpoints: {
			// En pantallas más grandes, muestra más miniaturas
			768: {
				slidesPerView: 6,
			},
		},
	});

	// 2. Inicializar Swiper Principal (Imagen Grande)
	const galleryTop = new Swiper("#swiper-main", {
		spaceBetween: 0,
		loop: true,
		// Enlazar el Swiper principal con el Swiper de miniaturas
		thumbs: {
			swiper: galleryThumbs,
		},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
	});
});
