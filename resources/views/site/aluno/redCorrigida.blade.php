@extends('layouts._partials._cabecalho')
<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/correcao.css') }}">
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
                <div class="container-seta">
                    <a href="{{ url()->previous() }}" class="seta-back">
                        <i class="material-icons">arrow_back</i>
                    </a>
                </div>
                <div class="info-correcao info-nome">{{ $redacao->nome_aluno }}</div>
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

        <!-- FEEDBACK -->
        <section class="section-cinza feedback-correcao"> 
            <div class="titulo-section">Feedback</div>
            <hr class="linha-section">
            <div class="texto"> {{ $redacao->comentario }}</div>
        </section>

        <!-- GRADES DE CORRECAO ----------------- -->
        <section class="section-cinza nota-correcao">
            <div class="titulo-section">Grade de Correção - {{ $redacao->banca_nome }}</div>
            <hr class="linha-section">
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
    <script src="{{ asset('js/cardsDropdown.js') }}"></script>
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
