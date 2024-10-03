let serialPort;
let reader;
let detectionCount = 0; // Contador de detecções
let currentPlayer = null; // Armazena o jogador atual
let isReading = false; // Controle para leitura do Arduino

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
        isReading = true; // Atualiza o controle de leitura

        // Leitura contínua da porta serial
        while (isReading) {
            const { value, done } = await reader.read();
            if (done) {
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

document.getElementById('jogadores').addEventListener('change', async function() {
    const selectedPlayer = this.value;
    const jogadorSelecionado = document.getElementById('jogadorSelecionado');

    // Salva a pontuação do jogador anterior antes de mudar
    if (currentPlayer) {
        await saveScore(currentPlayer, detectionCount);

        // Envia o comando de reset para o Arduino
        if (serialPort && isReading) {
            const writer = serialPort.writable.getWriter();
            await writer.write(new TextEncoder().encode("RESET\n")); // Envia o comando de reset
            writer.releaseLock();
        }
    }

    // Atualiza o jogador atual e o cabeçalho
    if (selectedPlayer) {
        currentPlayer = selectedPlayer;
        jogadorSelecionado.textContent = currentPlayer; // Atualiza o texto do cabeçalho

        // Reinicia a contagem visualmente
        detectionCount = 0; // Reinicia a contagem para o novo jogador
        counterDisplay.textContent = detectionCount; // Atualiza o placar na página
    } else {
        jogadorSelecionado.textContent = "Selecione um Jogador"; // Reseta o texto se nada for selecionado
    }
});

// Função para salvar a pontuação do jogador
async function saveScore(playerName, score) {
    try {
        const response = await fetch('atualiza_pont.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `nome=${encodeURIComponent(playerName)}&pontuacao=${encodeURIComponent(score)}`
        });

        const data = await response.text();
        console.log('Resposta do servidor:', data);
    } catch (error) {
        console.error('Erro ao enviar dados:', error);
    }
}
