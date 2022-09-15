const search = document.querySelectorAll('#liveSearch input');

const liveSearch = (e) => {

  if (e.target.matches("#buscador")){

      if (e.key ==="Escape")e.target.value = ""
      if (e.value == 0)document.querySelectorAll(".articulo").classList.add("filtro")

      document.querySelectorAll(".articulo").forEach(fruta =>{

          fruta.textContent.toLowerCase().includes(e.target.value.toLowerCase())
          ?fruta.classList.remove("filtro")
          :fruta.classList.add("filtro")
      })

  }

}

search.forEach((input) => {
	input.addEventListener('keyup', liveSearch);
	input.addEventListener('blur', liveSearch);
  input.addEventListener('change', liveSearch);
});