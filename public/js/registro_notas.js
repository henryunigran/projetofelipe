const form = document.getElementById('registroForm');
const alunoIdInput = document.getElementById('alunoId');
const disciplinaInput = document.getElementById('disciplina');
const notaInput = document.getElementById('nota');
const frequenciaInput = document.getElementById('frequencia');
const registroIdInput = document.getElementById('registroId');
const registrosTableBody = document.getElementById('registrosTableBody');
const feedback = document.getElementById('feedback');


function mostrarFeedback(mensagem, tipo = 'success') {
    feedback.classList.remove('d-none', 'alert-success', 'alert-danger');
    feedback.classList.add(`alert-${tipo}`);
    feedback.textContent = mensagem;
    setTimeout(() => feedback.classList.add('d-none'), 3000);
}


async function listarRegistros() {
    const response = await fetch('registro_notas/read.php');
    const registros = await response.json();

    registrosTableBody.innerHTML = '';
    registros.forEach(registro => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${registro.id}</td>
            <td>${registro.aluno_id}</td>
            <td>${registro.disciplina}</td>
            <td>${registro.nota}</td>
            <td>${registro.frequencia}%</td>
            <td>${registro.data_registro}</td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="editarRegistro(${registro.id})">Editar</button>
                <button class="btn btn-danger btn-sm" onclick="excluirRegistro(${registro.id})">Excluir</button>
            </td>
        `;
        registrosTableBody.appendChild(row);
    });
}


form.addEventListener('submit', async (event) => {
    event.preventDefault();

    const registro = {
        aluno_id: alunoIdInput.value,
        disciplina: disciplinaInput.value,
        nota: notaInput.value,
        frequencia: frequenciaInput.value
    };

    let url = 'registro_notas/create.php';
    let method = 'POST';

    if (registroIdInput.value) {
        registro.id = registroIdInput.value;
        url = 'registro_notas/update.php';
        method = 'PUT';
    }

    const response = await fetch(url, {
        method: method,
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(registro)
    });

    if (response.ok) {
        mostrarFeedback('Registro salvo com sucesso', 'success');
    } else {
        mostrarFeedback('Erro ao salvar registro', 'danger');
    }

    form.reset();
    registroIdInput.value = '';
    listarRegistros();
});


async function editarRegistro(id) {
    const response = await fetch(`registro_notas/read.php?id=${id}`);
    const registro = await response.json();

    registroIdInput.value = registro.id;
    alunoIdInput.value = registro.aluno_id;
    disciplinaInput.value = registro.disciplina;
    notaInput.value = registro.nota;
    frequenciaInput.value = registro.frequencia;
}


async function excluirRegistro(id) {
    const response = await fetch('registro_notas/delete.php', {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
    });

    if (response.ok) {
        mostrarFeedback('registro excluido com sucesso', 'success');
    } else {
        mostrarFeedback('erro ao excluir registro', 'danger');
    }

    listarRegistros();
}


listarRegistros();
