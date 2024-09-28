@extends('layouts._partials._cabecalho')
<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('css')
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="/css/correcao.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Correcao</title>
    @endsection
</head>
<body>
@section('conteudo')
    <main>

        <!-- CABECALHO -->
        <section class="info-correcao">

            <div class="container-info">
                <div class="info-correcao">{{ $redacao->nome_aluno }}</div>
                <div class="info-correcao">{{ $redacao->turma_nome }}</div>
            </div>

            <div class="container-tema">
                <div class="info-tema">{{ $redacao->frase_tematica }}</div>
                <div class="info-banca">{{ $redacao->banca_nome }}</div>
            </div>
            
        </section>

        <!-- FOTO DA REDACAO -->
        <section class="redacao-correcao">
            <article id="canvasarea">
                <canvas id="myCanvas"></canvas>
            </article>
        </section>
        
        <!-- LISTA DE CODIGOS -->
        <section class="section-cinza lista-codigos-correcao">
            <div class="titulo-section">Códigos para Correção</div>
            <hr class="linha-section codigos-margin">

            <article class="container-codigo">
                <button class="header-codigo" id="card1" data-mae="dropdown1"> A) Apresentação Estética </button>
                <ul class="options-codigo" id="dropdown1">
                    <li><input type="checkbox" name="A" disabled><p><b>A1.</b> Título: centralize-o, sem aspas ou grifo, sem ponto final. Deve ser criativo, adequado ao tema e relacionado ao texto, à tese e aos repertórios.</p></li>
                    <li><input type="checkbox" name="A" disabled><p><b>A2.</b> Respeite as margens.</p></li>
                    <li><input type="checkbox" name="A" disabled><p><b>A3.</b> Número: de zero a dez por extenso (exceto horas, datas e distâncias).</p></li>
                </ul>
            </article>

            <article class="container-codigo">
                <button class="header-codigo" id="card2" data-mae="dropdown2"> G) Gramática</button>
                <ul class="options-codigo" id="dropdown2">
                    <li><input type="checkbox" name="G" disabled><p><b>G1.</b> Pontuação: Não separe elementos com relação sintática direta por vírgulas.</p></li>
                    <li><input type="checkbox" name="G" disabled><p><b>G2.</b> Ortografia.</p></li>
                    <li><input type="checkbox" name="G" disabled><p><b>G3.</b> Concordância.</p></li>
                    <li><input type="checkbox" name="G" disabled><p><b>G4.</b> Regência.</p></li>
                    <li><input type="checkbox" name="G" disabled><p><b>G5.</b> Colocação pronominal.</p></li>
                    <li><input type="checkbox" name="G" disabled><p><b>G6.</b> Acentuação.</p></li>
                    <li><input type="checkbox" name="G" disabled><p><b>G7.</b> Crase.</p></li>
                    <li><input type="checkbox" name="G" disabled><p><b>G8.</b> Separação silábica.</p></li>
                </ul>
            </article>

            <article class="container-codigo">
                <button class="header-codigo" id="card3" data-mae="dropdown3"> E) Estrutura </button>
                <ul class="options-codigo" id="dropdown3">
                    <li><input type="checkbox" name="E" disabled><p><b>E1.</b> A tese deve ser objetiva – não misture argumentos à tese.</p></li>
                    <li><input type="checkbox" name="E" disabled><p><b>E2.</b> Parágrafo argumentativo curto, com pouca informação.</p></li>
                    <li><input type="checkbox" name="E" disabled><p><b>E3.</b> Organize melhor os argumentos/as ideias.</p></li>
                    <li><input type="checkbox" name="E" disabled><p><b>E4.</b> Texto circular.</p></li>
                    <li><input type="checkbox" name="E" disabled><p><b>E5.</b> Não elabore parágrafos que tenham um só período.</p></li>
                    <li><input type="checkbox" name="E" disabled><p><b>E6.</b> Não misture os argumentos à conclusão (ideia nova).</p></li>
                    <li><input type="checkbox" name="E" disabled><p><b>E7.</b> Conclusão ou desfecho não compatível.</p></li>
                    <li><input type="checkbox" name="E" disabled><p><b>E8.</b> Texto sem tese/sem posicionamento.</p></li>
                    <li><input type="checkbox" name="E" disabled><p><b>E9.</b> A tese deve estar no 1º § (introdução).</p></li>
                    <li><input type="checkbox" name="E" disabled><p><b>E10.</b> Observe a estrutura do § argumentativo.</p></li>
                    <li><input type="checkbox" name="E" disabled><p><b>E11.</b> Parágrafo sem Tópico Frasal.</p></li>
                    <li><input type="checkbox" name="E" disabled><p><b>E12.</b> Falta Evidência/Exemplificação.</p></li>
                    <li><input type="checkbox" name="E" disabled><p><b>E13.</b> Falta autoria/aprofunde a Análise/falta Análise.</p></li>
                    <li><input type="checkbox" name="E" disabled><p><b>E14.</b> Relacione melhor Evidência e Análise.</p></li>
                    <li><input type="checkbox" name="E" disabled><p><b>E15.</b> Falta Fechamento.</p></li>
                    <li><input type="checkbox" name="E" disabled><p><b>E16.</b> Reproduza a frase temática integralmente.</p></li>
                    <li><input type="checkbox" name="E" disabled><p><b>E17.</b> Defina/explicite a tese.</p></li>
                    <li><input type="checkbox" name="E" disabled><p><b>E18.</b> Retome a tese e os Tópicos Frasais.</p></li>                
                </ul>
            </article>

            <article class="container-codigo">
                <button class="header-codigo" id="card4" data-mae="dropdown4"> C) Conteúdo </button>
                <ul class="options-codigo" id="dropdown4">
                    <li><input type="checkbox" name="C" disabled><p><b>C1.</b> Argumentação superficial, pouco convincente.</p></li>
                    <li><input type="checkbox" name="C" disabled><p><b>C2.</b> Uso precário ou insuficiente dos textos de apoio.</p></li>
                    <li><input type="checkbox" name="C" disabled><p><b>C3.</b> Explicações desnecessárias.</p></li>
                    <li><input type="checkbox" name="C" disabled><p><b>C4.</b> Insuficiência de ideias.</p></li>
                    <li><input type="checkbox" name="C" disabled><p><b>C5.</b> Reprodução de senso comum.</p></li>
                    <li><input type="checkbox" name="C" disabled><p><b>C6.</b> Redundância. </p></li>
                    <li><input type="checkbox" name="C" disabled><p><b>C7.</b> Amplie o conteúdo. </p></li>
                    <li><input type="checkbox" name="C" disabled><p><b>C8.</b> Explore esta ideia. </p></li>
                    <li><input type="checkbox" name="C" disabled><p><b>C9.</b> Ideia mal explicada/lacuna. </p></li>
                    <li><input type="checkbox" name="C" disabled><p><b>C10.</b> Falta repertório/repertório não produtivo. </p> </li>
                    <li><input type="checkbox" name="C" disabled><p><b>C11.</b> Sobreposição de ideias/lacunas. </p></li>
                    <li><input type="checkbox" name="C" disabled><p><b>C12.</b> Não reproduza modelos prontos de redação. </p></li>
                </ul>
            </article>

            <article class="container-codigo">
                <button class="header-codigo" id="card5" data-mae="dropdown5"> L) Linguagem </button>
                <ul class="options-codigo" id="dropdown5">
                    <li><input type="checkbox" name="L" disabled><p><b>L1.</b> Mantenha o nível padrão: evite informalidades.</p></li>
                    <li><input type="checkbox" name="L" disabled><p><b>L2.</b> Melhore a linguagem, valorizando suas ideias.</p></li>
                    <li><input type="checkbox" name="L" disabled><p><b>L3.</b> Não se dirija ao leitor; evite apelos.</p></li>
                    <li><input type="checkbox" name="L" disabled><p><b>L4.</b> Linguagem coloquial.</p></li>
                    <li><input type="checkbox" name="L" disabled><p><b>L5.</b> Evite subjetivismos e intromissões. Não utilize a primeira pessoa do singular.</p></li>
                    <li><input type="checkbox" name="L" disabled><p><b>L6.</b> Palavra inadequada ao contexto. Consulte o dicionário. Desvio lexical. </p></li>
                </ul>
            </article>

            <article class="container-codigo">
                <button class="header-codigo" id="card6" data-mae="dropdown6"> S) Coesão </button>
                <ul class="options-codigo" id="dropdown6">
                    <li><input type="checkbox" name="S" disabled><p><b>S1.</b> Melhore a elaboração dos períodos, mantendo a clareza e a coesão/problema de construção frasal (Estrutura sintática).</p></li>
                    <li><input type="checkbox" name="S" disabled><p><b>S2.</b> Atente-se à coesão entre os parágrafos; não os fragmente.</p></li>
                    <li><input type="checkbox" name="S" disabled><p><b>S3.</b> Ideias desconexas.</p></li>
                    <li><input type="checkbox" name="S" disabled><p><b>S4.</b> Ausência de conectivo.</p></li>
                    <li><input type="checkbox" name="S" disabled><p><b>S5.</b> Uso indevido de conectivo.</p></li>
                    <li><input type="checkbox" name="S" disabled><p><b>S6.</b> Varie os elementos coesivos/repetição de coesivos.</p></li>              
                </ul>
            </article>

            <article class="container-codigo">
                <button class="header-codigo" id="card7" data-mae="dropdown7"> R) Coerência </button>
                <ul class="options-codigo" id="dropdown7">
                    <li><input type="checkbox" name="R" disabled><p><b>R1.</b> Ideias contraditórias/incoerência.</p></li>
                    <li><input type="checkbox" name="R" disabled><p><b>R2.</b> Fuga ao tema.</p></li>
                    <li><input type="checkbox" name="R" disabled><p><b>R3.</b> Tangenciamento do tema.</p></li>
                    <li><input type="checkbox" name="R" disabled><p><b>R4.</b> Incompatibilidade de ideias.</p></li>
                    <li><input type="checkbox" name="R" disabled><p><b>R5.</b> Ideias desarticuladas.</p></li>
                    <li><input type="checkbox" name="R" disabled><p><b>R6.</b> Evite generalizações e preconceitos.</p></li>           
                </ul>
            </article>

            <article class="container-codigo">
                <button class="header-codigo" id="card8" data-mae="dropdown8"> Outras Informações </button>
                <ul class="options-codigo" id="dropdown8">
                    <li class="outras-op"> <b>Repetitivo (ideia ou termo)</b>     <b class="simbolo-codigo">//</b> </li>
                    <li class="outras-op"> <b>Não abrevie</b>                     <b class="simbolo-codigo">◯</b> </li>
                    <li class="outras-op"> <b>Outro parágrafo</b>                 <b class="simbolo-codigo">#</b>  </li>
                    <li class="outras-op"> <b>Quebra</b>                          <b class="simbolo-codigo">≠</b>  </li>      
                </ul>
            </article>
            
        </section>

        <!-- FEEDBACK -->
        <section class="section-cinza feedback-correcao"> 
            <div class="titulo-section">Feedback</div>
            <hr class="linha-section">
            <div class="texto"> {{ $redacao->comentario }}</div>
        </section>

        <!-- GRADES DE CORRECAO ----------------- -->
        <div class="titulo-section">Grade de Correção - {{ $redacao->banca_nome }}</div>
        <hr class="linha-section">
        <!-- Grade VUNESP -->
        <section class="section-cinza nota-correcao"> 
        <div class="tabela-container">
        <table class="tabela-nota">
            <tr>
                @foreach($criterios as $criterio)
                  <th><label for="criterio">{{ $criterio->nome }}</label></th>
                @endforeach
             </tr>
             <tr>
                @foreach($criterios as $criterio)
                    <td><p class="texto-criterio">{{ $criterio->descricao }}</p></td>
                @endforeach
            </tr>
            <tr>
                @foreach($criterios as $criterio)
                <td>
                    <input type="number" name="criterio[{{ $criterio->id }}]" class="input input-tabela" maxlength="2" required pattern="\d*" value="{{ isset($criterio->nota_aluno_criterio) ? $criterio->nota_aluno_criterio : '' }}" disabled>
                </td>
                @endforeach
                </tr>
                </table>
                </div>
                <div class="container-tabela-inferior">
                <label for="nota_aluno_redacao">
                <div class="nota-container">
                 <div class="nota-final">Nota: <input type="number" name="nota_aluno_redacao" id="nota_aluno_redacao" class="input" maxlength="2" required pattern="\d*" value="{{ isset($redacao->nota_aluno_redacao) ? $redacao->nota_aluno_redacao : '' }}" disabled></div>
                </div>
                </label>
            </div> 
        </section>

</body>
<script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
    <script src="/js/cardsDropdown.js"></script>
    <script>
        const canvas = document.getElementById('myCanvas');
        const redacaoId = {{ $redacao->id }};
        const ctx = canvas.getContext('2d');
        let painting = false;
        let colors = 'black';
        let lineWidth = 5;
        let brushstyle = 'round';
        let currentOpacity = 1; // Opacidade inicial
        let img = null;
        let imageData = null; // Variável para armazenar o estado inicial da imagem
        let history = []; // Array para armazenar o histórico de alterações

        function init() {
            const filePath = '{{ asset('assets/redacao_corrigida/' . ($redacao->redacao_corrigida ?? '')) }}';
            console.log('Caminho da imagem:', filePath);
            if (filePath) {
                loadImage(filePath);
            } else {
                console.error('Caminho da imagem não definido.');
            }
        }
        
        window.onload = init;

        function startPosition(e) {
            painting = true;
            saveState();  // Salva o estado atual antes de começar a desenhar
            draw(e);
        }

        function endPosition() {
            painting = false;
            ctx.beginPath();
        }

        function draw(e) {
            if (!painting) return;

            const rect = canvas.getBoundingClientRect();
            const scaleX = canvas.width / rect.width; // Proporção horizontal
            const scaleY = canvas.height / rect.height; // Proporção vertical

            const x = (e.clientX - rect.left) * scaleX;
            const y = (e.clientY - rect.top) * scaleY;

            ctx.lineWidth = lineWidth;
            ctx.lineCap = brushstyle;
            ctx.strokeStyle = colors;
            ctx.globalAlpha = currentOpacity;  // Define a opacidade

            ctx.lineTo(x, y);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(x, y);
        }

        canvas.addEventListener('mousedown', startPosition);
        canvas.addEventListener('mouseup', endPosition);
        canvas.addEventListener('mousemove', draw);

        function changeColors(palette) {
            colors = window.getComputedStyle(palette).backgroundColor;
        }

        function changeBrushStyle(style) {
            brushstyle = style;
        }

        function clearCanvas() {
            // Redesenha a imagem original, mantendo o estado inicial do canvas
            if (imageData) {
                ctx.putImageData(imageData, 0, 0);
            }
            history = []; // Limpa o histórico
        }

        function loadImage(filePath) {
            img = new Image();
            img.onload = function() {
                console.log('Imagem carregada com sucesso.');

                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
                imageData = ctx.getImageData(0, 0, canvas.width, canvas.height); // Salva o estado inicial da imagem
                saveState(); // Salva o estado inicial no histórico
            };
            img.onerror = function() {
                console.error('Erro ao carregar a imagem:', filePath);
            };
            img.src = filePath;
        }

        function updateLineWidth(value) {
            lineWidth = value;
            document.querySelector('input[name="amountInput"]').value = value;
            document.querySelector('input[name="amountRange"]').value = value;
        }

        // Função para atualizar a opacidade do grifo
        document.getElementById('opacityRange').addEventListener('input', function() {
            currentOpacity = this.value;
            document.getElementById('opacityValue').textContent = currentOpacity;
        });

        // Função para salvar a imagem
        document.getElementById('saveBtn').addEventListener('click', function() {
        const dataURL = canvas.toDataURL('image/png');
        const formData = new FormData();
        formData.append('image', dataURL);
        console.log(redacaoId);
        console.log('Enviando dados:', dataURL); // Verifica se o dataURL está correto

        fetch(`/save-edited-image/${redacaoId}`, { // Use template literals para construir a URL
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Resposta do servidor:', data); // Verifica a resposta do servidor
            if (data.success) {
                alert('Imagem salva com sucesso!');
            } else {
                alert('Erro ao salvar a imagem.');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao salvar a imagem.');
        });
        });



        // Função para desfazer a última alteração
        function undo() {
            if (history.length > 0) {
                ctx.putImageData(history.pop(), 0, 0);  // Restaura o último estado salvo
            }
        }

        // Função para salvar o estado atual do canvas no histórico
        function saveState() {
            history.push(ctx.getImageData(0, 0, canvas.width, canvas.height));
        }
    </script>
@endsection