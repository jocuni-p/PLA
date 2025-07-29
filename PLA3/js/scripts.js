//definir función para trasladar los datos de la persona a modificar al formulario oculto
function trasladarDatos(ev) {
	
	let botonPulsado = ev.target
	
	//situarnos en la etiqueta tr que corresponda a la fila donde se encuentra el botón
	let tr = botonPulsado.closest('tr')
	0
	//recuperar los datos de la persona
	let nif = tr.querySelector('.nif').innerText
	let nombre = tr.querySelector('.nombre').value
	let direccion = tr.querySelector('.direccion').value
	
	//trasladar los datos al formulario oculto
	document.querySelector('#nifModi').value = nif
	document.querySelector('#nombreModi').value = nombre
	document.querySelector('#direccionModi').value = direccion
	
	//submit del formulario
	document.querySelector('#formularioModi').submit()
	
}