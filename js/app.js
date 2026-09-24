const menuBtn = document.getElementById("menuBtn");
const menu = document.getElementById("menu");
const anio = document.getElementById("anio");
if (anio) anio.textContent = new Date().getFullYear();
if (menuBtn && menu) {
  const setMenu = (open) => {
    menu.classList.toggle("abierto", open);
    menuBtn.setAttribute("aria-expanded", String(open));
    menuBtn.setAttribute("aria-label", open ? "Cerrar menú" : "Abrir menú");
  };
  menuBtn.addEventListener("click", () => setMenu(menuBtn.getAttribute("aria-expanded") !== "true"));
  menu.querySelectorAll("a").forEach((link) => link.addEventListener("click", () => setMenu(false)));
  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && menu.classList.contains("abierto")) {setMenu(false); menuBtn.focus();}
  });
  window.matchMedia("(min-width: 901px)").addEventListener("change", () => setMenu(false));
}
