
//para previsualizar la imagen que seleccionamos en el selector
//  de archivo del formulario de alta

function previsualizar(ev) {
	//recuperar los objetos de imagen de portada y previsualizacion del DOM
	const imagen = ev.target.files[0];
	const caja = document.querySelector("#previsualizar");
	// Si no hay imagen seleccionada añadimos la imagen por defecto y salimos de la función
	if (!imagen) {
		caja.src = "/img/sinportada.jpg";
		return;
	}
	//Convertimos la imagen a un objeto de tipo objectURL
	const objectURL = URL.createObjectURL(imagen);
	// Y a la fuente de la imagen de la sección derecha le ponemos el objectURL
	caja.src = objectURL;
}

