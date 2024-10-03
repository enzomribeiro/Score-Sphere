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

document.getElementById('jogadores').addEventListener('change', function() {
    var selectedPlayer = this.value;
    var jogadorSelecionado = document.getElementById('jogadorSelecionado');

    // Atualiza o conteúdo do h1 com o nome do jogador selecionado
    if (selectedPlayer) {
        jogadorSelecionado.textContent = selectedPlayer; // Atualiza o texto do cabeçalho
    } else {
        jogadorSelecionado.textContent = "Selecione um Jogador"; // Reseta o texto se nada for selecionado
    }
});

