document.addEventListener("DOMContentLoaded", () => {
    const apiUrl = "http://seu-endereco-da-api.com/api/registro_notas";

    const formRegistro = document.getElementById("formRegistro");
    const registrosTable = document.getElementById("registrosTable").getElementsByTagName("tbody")[0];


    function loadRegistros() {
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                registrosTable.innerHTML = "";
                data.forEach(registro => {
                    const row = registrosTable.insertRow();
                    row.innerHTML = `
                        <td>${registro.id}</td>
                        <td>${registro.aluno_id}</td>
                        <td>${registro.nota}</td>
                        <td>${registro.frequencia}</td>
                        <td>
                            <button onclick="editRegistro(${registro.id})" class="btn btn-warning btn-sm">Editar</button>
                            <button onclick="deleteRegistro(${registro.id})" class="btn btn-danger btn-sm">Excluir</button>
                        </td>
                    `;
                });
            });
    }


    formRegistro.addEventListener("submit", event => {
        event.preventDefault();

        const aluno_id = document.getElementById("aluno_id").value;
        const nota = document.getElementById("nota").value;
        const frequencia = document.getElementById("frequencia").value;

        fetch(apiUrl, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ aluno_id, nota, frequencia })
        })
        .then(response => response.json())
        .then(() => {
            formRegistro.reset();
            loadRegistros();
        })
        .catch(error => console.error("Erro ao adicionar registro:", error));
    });

    window.editRegistro = (id) => {
        const aluno_id = prompt("Novo ID do Aluno:");
        const nota = prompt("Nova Nota:");
        const frequencia = prompt("Nova Frequência (%):");

        if (aluno_id && nota && frequencia) {
            fetch(`${apiUrl}/${id}`, {
                method: "PUT",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ aluno_id, nota, frequencia })
            })
            .then(response => response.json())
            .then(() => loadRegistros())
            .catch(error => console.error("Erro ao editar registro:", error));
        }
    };


    window.deleteRegistro = (id) => {
        if (confirm("Tem certeza que deseja excluir este registro?")) {
            fetch(`${apiUrl}/${id}`, { method: "DELETE" })
                .then(() => loadRegistros())
                .catch(error => console.error("Erro ao excluir registro:", error));
        }
    };

    loadRegistros();
});
