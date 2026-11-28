
// =====================================
// GERENCIAMENTO DINÂMICO DE PERGUNTAS
// =====================================

const listaPerguntas = document.getElementById("listaPerguntas");

function adicionarPergunta() {

    const index = listaPerguntas.children.length;

    const card = document.createElement("div");

    card.className = "card shadow-sm mb-4 pergunta-card";
    card.dataset.index = index;

    card.innerHTML = `
        <div class="card-body p-4">

            <div class="d-flex justify-content-between mb-3">

                <h5 class="fw-bold titulo-pergunta">
                    Pergunta ${index + 1}
                </h5>

                <button type="button"
                        class="btn btn-outline-danger btn-sm"
                        onclick="this.closest('.pergunta-card').remove(); atualizarNumeracao()">
                    <i class="bi bi-trash"></i> Remover
                </button>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Enunciado da pergunta
                </label>

                <textarea class="form-control"
                          name="perguntas[${index}][enunciado]"
                          required rows="2"></textarea>

            </div>

            <label class="form-label fw-bold">
                Alternativas
            </label>

            <p class="small text-muted">
                Marque a resposta correta.
            </p>

            <div class="lista-alternativas">

                ${criarAlternativa(index, 0)}
                ${criarAlternativa(index, 1)}

            </div>

            <button type="button"
                    class="btn btn-outline-primary btn-sm"
                    onclick="adicionarAlternativa(this)">
                <i class="bi bi-plus"></i>
                Adicionar alternativa
            </button>

        </div>
    `;

    listaPerguntas.appendChild(card);

    atualizarNumeracao();
}


// =====================================
// CRIAR ALTERNATIVA
// =====================================

function criarAlternativa(pergunta, indice) {

    return `
        <div class="input-group mb-2 alternativa-item">

            <div class="input-group-text">
                <input type="radio"
                       class="form-check-input mt-0"
                       name="perguntas[${pergunta}][correta]"
                       value="${indice}"
                       ${indice === 0 ? "checked" : ""}
                       required>
            </div>

            <input type="text"
                   class="form-control"
                   name="perguntas[${pergunta}][alternativas][${indice}]"
                   placeholder="Digite a alternativa"
                   required>

            <button type="button"
                    class="btn btn-outline-danger"
                    onclick="removerAlternativa(this)">
                <i class="bi bi-x-lg"></i>
            </button>

        </div>
    `;
}


// =====================================
// ADICIONAR ALTERNATIVA
// =====================================

function adicionarAlternativa(botao) {

    const pergunta = botao.closest(".pergunta-card");

    const indexPergunta = pergunta.dataset.index;

    const lista = pergunta.querySelector(".lista-alternativas");

    const indexAlternativa = lista.children.length;

    lista.insertAdjacentHTML(
        "beforeend",
        criarAlternativa(indexPergunta, indexAlternativa)
    );
}


// =====================================
// REMOVER ALTERNATIVA
// =====================================

function removerAlternativa(botao) {

    const lista = botao.closest(".lista-alternativas");

    if (lista.children.length <= 2) {
        alert("Uma pergunta precisa ter pelo menos duas alternativas.");
        return;
    }

    const estavaSelecionada =
        botao.closest(".alternativa-item")
             .querySelector("input[type=radio]").checked;

    botao.closest(".alternativa-item").remove();

    reindexarAlternativas(lista);

    if (estavaSelecionada) {
        lista.querySelector('input[type="radio"]').checked = true;
    }
}


// =====================================
// REINDEXAR ALTERNATIVAS
// =====================================

function reindexarAlternativas(lista) {

    const pergunta = lista.closest(".pergunta-card");

    const indexPergunta = pergunta.dataset.index;

    lista.querySelectorAll(".alternativa-item").forEach((item, i) => {

        const radio = item.querySelector('input[type="radio"]');
        const texto = item.querySelector('input[type="text"]');

        radio.name = `perguntas[${indexPergunta}][correta]`;
        radio.value = i;

        texto.name =
            `perguntas[${indexPergunta}][alternativas][${i}]`;

    });
}


// =====================================
// ATUALIZAR NUMERAÇÃO
// =====================================

function atualizarNumeracao() {

    Array.from(listaPerguntas.children).forEach((card, i) => {

        card.dataset.index = i;

        card.querySelector(".titulo-pergunta").textContent =
            `Pergunta ${i + 1}`;

        const textarea = card.querySelector("textarea");

        textarea.name = `perguntas[${i}][enunciado]`;

        reindexarAlternativas(
            card.querySelector(".lista-alternativas")
        );

    });
}
