window.onload = function() {
    // Array de imágenes para cambiar al actualizar la página
    const images = ['navidad/fondos/fondo_a.jpg', 'navidad/fondos/fondo_b.jpg', 'navidad/fondos/fondo_c.jpg', 'navidad/fondos/fondo_d.jpg'];
    const images_footer = ['navidad/footers/footer_a.jpg', 'navidad/footers/footer_b.jpg', 'navidad/footers/footer_c.jpg', 'navidad/footers/footer_d.jpg'];
    const images_jack = ['navidad/jack/jack_a.gif', 'navidad/jack/jack_b.gif', 'navidad/jack/jack_c.gif','navidad/jack/jack_d.gif','navidad/jack/jack_e.gif'];

    // Seleccionar una imagen al azar del array
    const variable = Math.random();
    const randomImage = images[Math.floor(variable * images.length)];
    const randomImageFooter = images_footer[Math.floor(variable * images_footer.length)];
    const randomImageJack = images_jack[Math.floor(Math.random()*images_jack.length)];
    // Cambiar la imagen de fondo en .image-container
    document.querySelector('.image-container').style.backgroundImage = `url(${randomImage})`;
    document.querySelector('.footer-container').style.backgroundImage = `url(${randomImageFooter})`;
    document.querySelector('.boton-container').style.backgroundImage = `url(${randomImageFooter})`;
    document.querySelector('.imagen_jack').style.backgroundImage = `url(${randomImageJack})`;

    setTimeout(function() {
        var imagenJack = document.querySelector('.imagen_jack');
        // Primero reduce la opacidad para la transición de salida
        imagenJack.classList.add('fade-out');

        // Espera la duración de la transición (1s), luego cambia la imagen y muestra con la transición de entrada
        setTimeout(function() {
            imagenJack.style.backgroundImage = "url('imagenes/logo.png')"; // Cambia la imagen
            imagenJack.classList.remove('fade-out');
            imagenJack.classList.add('fade-in'); // Vuelve a mostrar con la nueva imagen
            imagenJack.style.width = "250px";
            imagenJack.style.height = "250px";
            imagenJack.style.backgroundSize = "contain";
        }, 1250); // Tiempo que coincide con la duración de la transición
    }, 2000);

};
