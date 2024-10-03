let serialPort;
let reader;
let detectionCount = 0;

const counterDisplay = document.getElementById('counter');
const connectButton = document.getElementById('connectButton');

// Função para ler a porta serial
async function connectToSerial() {
    try {
        // Solicita ao usuário que selecione a porta serial
        serialPort = await navigator.serial.requestPort();
        await serialPort.open({ baudRate: 9600 });

        // Leitor da porta serial
        reader = serialPort.readable.getReader();

        // Leitura contínua da porta serial
        while (true) {
            const { value, done } = await reader.read();
            if (done) {
                // Se a leitura terminar, fecha o leitor
                reader.releaseLock();
                break;
            }

            // Converte os dados da serial para texto
            const text = new TextDecoder().decode(value);
            console.log(text); // Para depuração, mostra o texto no console

            // Remove quebras de linha e espaços
            const cleanText = text.trim();

            // Verifica se o valor recebido é um número válido
            if (!isNaN(cleanText) && cleanText.length > 0) {
                detectionCount = parseInt(cleanText);
                counterDisplay.textContent = detectionCount; // Atualiza o placar na página
            }
        }
    } catch (error) {
        console.log('Erro ao conectar:', error);
    }
}

// Evento ao clicar no botão de conectar
connectButton.addEventListener('click', connectToSerial);

// Função para popular o select de jogadores a partir do localStorage
function popularSelectJogadores() {
    const jogadores = JSON.parse(localStorage.getItem('jogadores')) || [];
    const select = document.getElementById('jogadores');

    jogadores.forEach(jogador => {
        const option = document.createElement('option');
        option.value = jogador.nome;
        option.text = jogador.nome;
        select.appendChild(option);
    });
}

// Função para exibir o nome do jogador selecionado
function exibirNomeJogador() {
    const select = document.getElementById('jogadores');
    const jogadorSelecionado = document.getElementById('jogadorSelecionado');

    select.addEventListener('change', function() {
        if (select.value) {
            jogadorSelecionado.textContent = select.value;
        } else {
            jogadorSelecionado.textContent = 'Selecione um Jogador';
        }
    });
}

// Função para inicializar o contador (já existente)
function inicializarContador() {
    let counter = 0;
    const counterDiv = document.getElementById('counter');
    const connectButton = document.getElementById('connectButton');

    connectButton.addEventListener('click', () => {
        // Simulação de incremento no contador ao conectar
        counter++;
        counterDiv.textContent = counter;
    });
}

// Inicializa o select de jogadores, exibição do nome e o contador
document.addEventListener('DOMContentLoaded', function() {
    popularSelectJogadores();
    exibirNomeJogador();
    inicializarContador();
});
