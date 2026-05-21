function abrirIA() {
    document.getElementById("modalIA").style.display = "block";
    // Limpiar estados previos al abrir
    document.getElementById("resultado").style.display = "none";
    document.getElementById("status-container").style.display = "none";
    document.getElementById("prompt").value = "";
    document.getElementById("btnGenerar").disabled = false;
}

function cerrarIA() {
    document.getElementById("modalIA").style.display = "none";
}

function actualizarEstado(mensaje, mostrarSpinner = true) {
    const container = document.getElementById("status-container");
    const text = document.getElementById("status-text");
    const spinner = container.querySelector(".spinner");

    container.style.display = "block";
    text.innerText = mensaje;
    spinner.style.display = mostrarSpinner ? "block" : "none";
}

const API_BASE = "/ask/Api-key/";

function generar() {
    let prompt = document.getElementById("prompt").value;

    if (!prompt.trim()) {
        alert("Por favor, escribe un tema para el video.");
        return;
    }

    // Bloquear botón y mostrar estado inicial
    const btnGenerar = document.getElementById("btnGenerar");
    btnGenerar.disabled = true;
    actualizarEstado("Redactando guion con IA...");

    // 1. Llamada a Gemini para el guion
    fetch(API_BASE + "generar-guion.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "prompt=" + encodeURIComponent(prompt)
    })
    .then(res => res.json()) // Cambiado a .json() directamente para mayor limpieza
    .then(data => {
        if (data.error) throw new Error(data.error);

        actualizarEstado("Guion listo. Iniciando generación de avatar...");
        
        // 2. Llamada a D-ID con el guion obtenido
        return fetch(API_BASE + "d-id.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "prompt=" + encodeURIComponent(data.guion)
        });
    })
    .then(res => res.json())
    .then(data => {
        if (data.error || !data.id) {
            const debug = data.debug ? " | debug: " + JSON.stringify(data.debug) : "";
            throw new Error((data.error || "No se obtuvo ID de video") + debug);
        }

        actualizarEstado("Procesando video... Esto puede tardar un minuto.");
        verificar(data.id);
    })
    .catch(err => {
        console.error("ERROR:", err);
        alert("Ocurrió un error: " + err.message);
        document.getElementById("status-container").style.display = "none";
        btnGenerar.disabled = false;
    });
}

function verificar(id) {
    fetch(API_BASE + "consultar.php?id=" + id)
    .then(res => res.json())
    .then(data => {
        if (data.status === "done") {
            // Video finalizado
            document.getElementById("status-container").style.display = "none";
            const resultado = document.getElementById("resultado");
            resultado.style.display = "block";
            resultado.innerHTML = `
                <p style="color: green; font-weight: bold;">¡Video generado con éxito!</p>
                <video controls width="100%" style="border: 2px solid #002244; margin-top:10px;">
                    <source src="${data.result_url}" type="video/mp4">
                    Tu navegador no soporta videos.
                </video>
                <br>
                <a href="${data.result_url}" download class="btn-ia-principal" style="display:block; text-align:center; text-decoration:none; margin-top:10px;">DESCARGAR VIDEO</a>
            `;
            document.getElementById("btnGenerar").disabled = false;
        } else if (data.status === "error") {
            const detalle = data.error ? ("\nDetalle: " + JSON.stringify(data.error)) : "";
            alert("D-ID no pudo procesar el video." + detalle);
            document.getElementById("status-container").style.display = "none";
            document.getElementById("btnGenerar").disabled = false;
        } else {
            // Seguir consultando cada 4 segundos
            actualizarEstado("El avatar está hablando... renderizando video...");
            setTimeout(() => verificar(id), 4000);
        }
    })
    .catch(err => {
        console.error("Error en verificación:", err);
        document.getElementById("status-container").style.display = "none";
        document.getElementById("btnGenerar").disabled = false;
        alert("Error verificando el video. Intenta generar de nuevo.");
    });
}