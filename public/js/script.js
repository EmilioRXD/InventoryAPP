const inputs = document.querySelectorAll('#formulario input');

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "codigo":
			let codigo = document.querySelector(".codigo");
			validarCampo(codigo,"codigo");
		break;
		case "producto":
			let producto = document.querySelector(".producto");
			validarCampo(producto,"producto");
		break;
		case "pCompra":
			let pCompra = document.querySelector('.pCompra');
			validarCampo(pCompra,"pCompra");
		break;
		case "pVenta":
			let pVenta = document.querySelector('.pVenta');
			validarCampo(pVenta,"pVenta");
		break;
		case "stock":
			let stock = document.querySelector('.stock');
			validarCampo(stock,"stock");
		break;
		case "minStock":
			let minStock = document.querySelector('.minStock');
			validarCampo(minStock,"minStock");
		break;
	}
}

const validarCampo = (expresion, campo) => {
	if(expresion.value.length == 0){
		document.getElementById(`${campo}`).classList.remove('hide');
		document.getElementById(`${campo}`).classList.add('show');
	}else{
		document.getElementById(`${campo}`).classList.remove('show');
		document.getElementById(`${campo}`).classList.add('hide');
	}
}	

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});