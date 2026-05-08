function abrirIA() {
    document.getElementById("modalIA").style.display = "block";
}

function cerrarIA() {
    document.getElementById("modalIA").style.display = "none";
}

function generar() {

    let prompt = document.getElementById("prompt").value;

    if (!prompt.trim()) {
        alert("Escribe un prompt");
        return;
    }

    fetch("/TUTORVIDEOS/Api-key/generar-guion.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "prompt=" + encodeURIComponent(prompt)
    })
    .then(res => res.text())
    .then(text => {

        console.log("RESPUESTA IA CRUDA:", text);

        let data;

        try {
            data = JSON.parse(text);
        } catch (e) {
            console.error(" RESPUESTA NO JSON:", text);
            alert("Error en IA (respuesta inválida)");
            return null;
        }

        if (data.error) {
            console.error(" ERROR BACKEND IA:", data.error, data.debug);
            alert("Error IA: " + data.error);
            return null;
        }

        let guion = data.guion;

        console.log("GUION:", guion);

        if (!guion || guion.trim() === "") {
            alert("No se pudo generar el guion");
            return null;
        }

        return fetch("/TUTORVIDEOS/Api-key/d-id.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "prompt=" + encodeURIComponent(guion)
        });
    })
    .then(res => {
        if (!res) return null;
        return res.text();
    })
    .then(text => {

        if (!text) return;

        console.log("RESPUESTA D-ID CRUDA:", text);

        let data;

        try {
            data = JSON.parse(text);
        } catch (e) {
            console.error("ERROR JSON D-ID:", text);
            return;
        }

        if (!data.id) {
            console.error("NO ID EN D-ID:", data);
            return;
        }

        verificar(data.id);
    })
    .catch(err => console.error("ERROR GENERAL:", err));
}

function verificar(id) {
    setTimeout(() => {
        fetch("/TUTORVIDEOS/Api-key/consultar.php?id=" + id)
        .then(res => res.json())
        .then(data => {
            if (data.status === "done") {
                document.getElementById("resultado").innerHTML =
                    `<video controls width="100%">
                        <source src="${data.result_url}">
                    </video>`;
            } else {
                verificar(id);
            }
        });
    }, 5000);
}