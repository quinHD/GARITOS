function rotacionImagenes(segundos)
{
	var i=0;
	setInterval(function(){cambiarFoto(++i)}, segundos *1000);
}

//Objeto Comercio
function Comercio (imagen, nombre, enlace)
{
	/*
		imagen: nombre de la imagen almacenada.
		nombre: nombre de la facultad que se mostrará.
		enlace: link a la página web de la facultad.
	*/
	this.nombre = nombre;
	this.imagen = imagen;
	this.enlace = enlace;
}

function cambiarFoto(i)
{
	//Declaración de variables
	var root = "img/";
	var arrayImagenes = [new Comercio("fotoCiencias.jpg","Comercio 1", "comercios.html#comercio1"), 
						 new Comercio("fotoDerecho.jpg", "Comercio 2", "comercios.html#comercio2"), 
						 new Comercio("fotoEconomicas.jpg", "Comercio 3", "comercios.html#comercio3"), 
						 new Comercio("fotoEducacion.jpg", "Comercio 4", "comercios.html#comercio4"), 
						 new Comercio("fotoFilologia.jpg", "Comercio 5", "comercios.html#comercio5"), 
						 new Comercio("fotoFilosofia.jpg", "Comercio 6", "comercios.html#comercio6"), 
						 new Comercio("fotoGeografiaHistoria.jpg", "Comercio 7", "comercios.html#comercio7"), 
						 new Comercio("fotoIndustriales130.jpg", "Comercio 8", "comercios.html#comercio8"), 
						 new Comercio("fotoInformatica.jpg", "Comercio 9", "comercios.html#comercio9"), 
						 new Comercio("fotoPsicologia.jpg", "Comercio 10", "comercios.html#comercio10")];

	//Algoritmo

	//Con el resto de la división entera vamos obteniendo cíclicamente los índices de los elementos almacenados en el array.
	var fac= arrayImagenes[i%arrayImagenes.length];
	
	document.getElementById("imagenComercio").src= root+fac.imagen;
	document.getElementById("nombreComercio").innerHTML= fac.nombre;
	document.getElementById("enlaceComercio").href= fac.enlace;

}

