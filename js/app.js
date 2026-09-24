const menuBtn = document.getElementById("menuBtn");
const menu = document.getElementById("menu");
const anio = document.getElementById("anio");

if (anio) {
  anio.textContent = new Date().getFullYear();
}

if (menuBtn && menu) {
  menuBtn.addEventListener("click", () => {
    menu.classList.toggle("abierto");
  });

  menu.querySelectorAll("a").forEach((enlace) => {
    enlace.addEventListener("click", () => {
      menu.classList.remove("abierto");
    });
  });
}