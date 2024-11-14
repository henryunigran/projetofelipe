const form = document.getElementById('alunoForm');
const nomeInput = document.getElementById('nome');
const idadeInput = document.getElementById('idade');
const turmaInput = document.getElementById('turma');
const alunoIdInput = document.getElementById('alunoId');
const alunosTableBody = document.getElementById('alunosTableBody');


async function listarAlunos() {
    const response = await fetch('alunos/read.php');
    const alunos = await response.json();

    alunosTableBody.innerHTML = '';
    alunos.forEach(aluno => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${aluno.id}</td>
            <td>${aluno.nome}</td>
            <td>${aluno.idade}</td>
            <td>${aluno.turma}</td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="editarAluno(${aluno.id})">Editar</button>
                <button class="btn btn-danger btn-sm" onclick="excluirAluno(${aluno.id})">Excluir</button>
            </td>
        `;
        alunosTableBody.appendChild(row);
    });
}


form.addEventListener('submit', async (event) => {
    event.preventDefault();

    const aluno = {
        nome: nomeInput.value,
        idade: idadeInput.value,
        turma: turmaInput.value
    };

    let url = 'alunos/create.php';
    let method = 'POST';


    if (alunoIdInput.value) {
        aluno.id = alunoIdInput.value;
        url = 'alunos/update.php';
        method = 'PUT';
    }

    await fetch(url, {
        method: method,
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(aluno)
    });

    form.reset();
    alunoIdInput.value = '';
    listarAlunos();
});


async function editarAluno(id) {
    const response = await fetch(`alunos/read.php?id=${id}`);
    const aluno = await response.json();

    alunoIdInput.value = aluno.id;
    nomeInput.value = aluno.nome;
    idadeInput.value = aluno.idade;
    turmaInput.value = aluno.turma;
}


async function excluirAluno(id) {
    await fetch('alunos/delete.php', {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
    });

    listarAlunos();
}


listarAlunos();
