// Array para armazenar jogadores cadastrados
let jogadores = JSON.parse(localStorage.getItem('jogadores')) || [];

// Obtém os elementos do formulário e da lista
const formCadastro = document.getElementById('formCadastro');
const listaJogadores = document.getElementById('listaJogadores');

// Função para atualizar a lista de jogadores na tela
function atualizarListaJogadores() {
    listaJogadores.innerHTML = '';

    jogadores.forEach((jogador) => {
        const li = document.createElement('li');
        li.textContent = `Nome: ${jogador.nome}, Sexo: ${jogador.sexo}, Escola: ${jogador.escola}`;
        listaJogadores.appendChild(li);
    });
}

// Função para lidar com o envio do formulário
formCadastro.addEventListener('submit', function(event) {
    event.preventDefault();

    // Obtém os valores dos campos
    const nome = document.getElementById('nome').value;
    const sexo = document.querySelector('input[name="sexo"]:checked').value;
    const escola = document.getElementById('escola').value;

    if (nome && sexo && escola) {
        const jogador = { nome, sexo, escola };

        jogadores.push(jogador);

        // Salva a lista de jogadores no localStorage
        localStorage.setItem('jogadores', JSON.stringify(jogadores));

        formCadastro.reset();
        atualizarListaJogadores();
    } else {
        alert('Preencha todos os campos.');
    }
});

// Chama para exibir os jogadores já cadastrados
atualizarListaJogadores();
