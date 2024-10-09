    document.addEventListener("DOMContentLoaded", function() {
        const jogadorSelecionado = document.getElementById("jogadorSelecionado");
        const jogadoresSelect = document.getElementById("jogadores");
        const counter = document.getElementById("counter");

        
        function ajustarTamanhoFonteEMargin() {
            const maxCaracteres = 27; 
            const texto = jogadorSelecionado.textContent;

            if (texto.length > maxCaracteres) {
                jogadorSelecionado.style.fontSize = "75px"; 
                counter.style.margin = "152px  auto"; 
            } else {
                jogadorSelecionado.style.fontSize = "85px"; 
                counter.style.margin = "136px  auto"; 
            }
        }

    
        jogadoresSelect.addEventListener("change", function() {
            const nomeJogador = jogadoresSelect.value; 
            if (nomeJogador) {
                jogadorSelecionado.textContent = nomeJogador;
                ajustarTamanhoFonteEMargin(); 
            } else {
                jogadorSelecionado.textContent = "Selecione um Jogador";
                jogadorSelecionado.style.fontSize = "85px"; 
                counter.style.marginTop = "136px  auto";
            }
        });

        ajustarTamanhoFonteEMargin();
    });

