// Seleccionar elementos del DOM
const formOpenBtn = document.querySelector("#form-open"), // Botón para abrir el formulario
  home = document.querySelector(".home"), // Sección principal
  formContainer = document.querySelector(".form_container"), // Contenedor del formulario
  formCloseBtn = document.querySelector(".form_close"), // Botón para cerrar el formulario
  signupBtn = document.querySelector("#signup"), // Enlace para ir al formulario de registro
  loginBtn = document.querySelector("#login"), // Enlace para ir al formulario de inicio de sesión
  pwShowHide = document.querySelectorAll(".pw_hide"); // Iconos para mostrar/ocultar la contraseña

// Evento para mostrar el formulario al hacer clic en el botón de inicio de sesión
formOpenBtn.addEventListener("click", () => home.classList.add("show"));

// Evento para ocultar el formulario al hacer clic en el botón de cerrar
formCloseBtn.addEventListener("click", () => home.classList.remove("show"));

// Evento para mostrar/ocultar la contraseña al hacer clic en el icono correspondiente
pwShowHide.forEach((icon) => {
  icon.addEventListener("click", () => {
    let getPwInput = icon.parentElement.querySelector("input");
    if (getPwInput.type === "password") {
      getPwInput.type = "text";
      icon.classList.replace("uil-eye-slash", "uil-eye");
    } else {
      getPwInput.type = "password";
      icon.classList.replace("uil-eye", "uil-eye-slash");
    }
  });
});


