// Função para gerar o select de acordo com a escolha do filtro
function gerarSelect(opcao) {
    const container = document.getElementById('filtroContainer');
    container.innerHTML = '';  // Limpa qualquer conteúdo anterior

    // Recupera os jogadores do localStorage
    const jogadores = JSON.parse(localStorage.getItem('jogadores')) || [];
    
    let select = document.createElement('select');
    
    if (opcao === 'nome') {
        jogadores.forEach(jogador => {
            let option = document.createElement('option');
            option.value = jogador.nome;
            option.text = jogador.nome;
            select.appendChild(option);
        });
    } else if (opcao === 'sexo') {
        let sexos = ['Masculino', 'Feminino'];
        sexos.forEach(sexo => {
            let option = document.createElement('option');
            option.value = sexo;
            option.text = sexo;
            select.appendChild(option);
        });
    } else if (opcao === 'escola') {
        let escolas = [...new Set(jogadores.map(jogador => jogador.escola))]; // Remove duplicatas
        escolas.forEach(escola => {
            let option = document.createElement('option');
            option.value = escola;
            option.text = escola;
            select.appendChild(option);
        });
    }

    container.appendChild(select);
}

// Função para monitorar a mudança no rádio button
function monitorarMudanca() {
    document.querySelectorAll('input[name="filtro"]').forEach(radio => {
        radio.addEventListener('change', function() {
            gerarSelect(this.value);
        });
    });
}

// Inicia o monitoramento assim que a página carrega
document.addEventListener('DOMContentLoaded', monitorarMudanca);
