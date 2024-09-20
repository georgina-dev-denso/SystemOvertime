
// Función para mostrar mensajes de éxito
function showSuccessMessage(message) {
    const messagesElement = document.getElementById('messages');
    messagesElement.innerHTML = '<div class="message success"><i class="uil uil-check-circle"></i><button class="close-button" onclick="closeMessage()">Cerrar</button><span>' + message + '</span></div>';
}

// Función para mostrar mensajes de error
function showErrorMessage(message) {
    const messagesElement = document.getElementById('messages');
    messagesElement.innerHTML = '<div class="message error"><i class="uil uil-times-circle"></i><button class="close-button" onclick="closeMessage()">Cerrar</button><span>' + message + '</span></div>';
}

// Función para cerrar el mensaje
function closeMessage() {
    const messagesElement = document.getElementById('messages');
    messagesElement.innerHTML = '';
}

document.addEventListener("DOMContentLoaded", function() {
// Escuchar el evento de envío del formulario
document.querySelector(".signup_form").addEventListener("submit", function(event) {
    event.preventDefault(); // Evitar el envío del formulario por defecto

    // Obtener los datos del formulario
    var formData = new FormData(this);

    fetch("registrartl.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text()) // Convertir la respuesta a texto
    .then(data => {
        // Verificar si la respuesta contiene el mensaje JSON
        const jsonStartIndex = data.indexOf('{');
        const jsonString = data.substring(jsonStartIndex);
        const responseObject = JSON.parse(jsonString);

        // Verificar si el tipo de mensaje es de éxito o error
        if (responseObject.type === "success") {
            showSuccessMessage("¡TL registrado correctamente!");
            // Limpiar el formulario después de enviar con éxito
            this.reset();
        } else if (responseObject.type === "error") {
            // Manejar diferentes tipos de errores
            switch (responseObject.message) {
                case "La nómina ya está registrada":
                    showErrorMessage(responseObject.message);
                    // Limpiar el formulario después de enviar con éxito
                     this.reset();
                    break;
                case "Las contraseñas no coinciden":
                    showErrorMessage(responseObject.message);
                    break;
                default:
                    showErrorMessage("Error desconocido: " + responseObject.message);
                    break;
            }
        } else {
            showErrorMessage("Respuesta del servidor no válida. Por favor, inténtalo de nuevo más tarde.");
        }
    })
    .catch(error => {
        console.error("Error al enviar el formulario:", error);
        showErrorMessage("Error al enviar el formulario. Por favor, inténtalo de nuevo más tarde.");
    });
});
});
