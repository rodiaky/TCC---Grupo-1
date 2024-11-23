<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palavrear</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeralTI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleCabecalhoTI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles_home.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleRodape.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="shortcut icon" type="imagex/png" href="{{ asset('assets/img/iconePalavrear.ico') }}">
</head>
<body>

    <header>

        <div class="cabecalho">
            <img class="logo" src="{{ asset('assets/img/logo.svg') }}" href="#">
            <a href="{{ route('login', ['erro' => 6]) }}"><div class="entrar">Entrar</div></a>
        </div>
        
    </header>
    
    <section class="banner" id="ancora1">
        <div class="container-texto">
            <h1>Palavrear</h1>
            <p>Bem-vindo à Palavrear, uma escola dedicada ao ensino de redação e língua portuguesa, onde as palavras ganham vida e constroem caminhos para o conhecimento. Nossa missão é ajudar alunos e profissionais a desenvolverem suas habilidades de escrita, interpretação e comunicação de forma clara, objetiva e criativa.</p>
        </div>
        <img src="https://www.napratica.org.br/wp-content/uploads/2019/10/livros-mais-usados.jpg" alt="">
    </section>

    <h1 class="titulo" id="ancora2">Nossa Missão</h1>
    <div class="container-sobre-nos">
    <section class="sobre-nos">
        <div class="container-img"><img src="{{ asset('assets/img/vetor1.svg') }}" alt=""></div>
        <p>A Palavrear Escola de Língua Portuguesa surgiu em agosto de 2016, situada na Zona Sul de Bauru, no Jardim Europa. 
Como "sonho que se sonha junto é realidade", os professores (e casal) Paola e Diego deram início à Palavrear, com curso de Redação preparatório para o vestibular. 
Ao longo dos anos, fomos ampliando nossa escola, e nossos sonhos foram vencendo fronteiras! Hoje, disponibilizamos aulas de Redação, de Gramática e de Interpretação de Textos, virtual e presencialmente, com cursos, aulas particulares e correção e revisão de textos. 
Nossa missão é formar leitores, leitoras, escritores e escritoras críticos, reflexivos, autores e autoras de seus textos e de suas vidas. 
O mundo é melhor com pessoas que leem e escrevem autonomamente, e nossa meta é contribuir com isso. Somos muito honrados por atuar na área da educação, com amor, compromisso e dedicação! 🧡</p></div>
    </section>
    </div>

    <h1 class="titulo" id="ancora3">Sobre Nós</h1>
    <div class="container-sobre-nos">
        <section class="sobre-nos">
            <ul>
                <li class="item-lista">
                    <div class="circulo"><i class="fa-solid fa-book-open"></i></div>
                    <p>Paola Leutwiler Oliveira Moraes é nascida nos famigerados anos 1980, em Arealva, uma cidade pequena do interior paulista. Desde criança, ama ler, escrever, criar e contar histórias. 
Formada em Magistério no CEFAM de Bauru, em Letras pela UNESP de Araraquara, onde também fez pós-graduação Lato Sensu em "Teorias Linguísticas e Ensino", ela também fez Mestrado em Mídia e Tecnologia na Unesp de Bauru sobre educação antirracista. </p>
                </li>

                <li class="item-lista">
                    <div class="circulo"><i class="fa-solid fa-pencil"></i></div>
                    <p>Apaixonada pela educação, já atingiu a maioridade na docência, caminho que pretende seguir sempre com muito amor e empenho.</p>
                </li>

            </ul>
            <div class="container-img">
                <img src="{{ asset('assets/img/vetor2.svg') }}" alt=""></div>
        </section>
    </div>

    <section class="inscricao" id="ancora4">
      <div class="container-info-inscricao">
        <div class="info-inscricao">
          <h1>Entre em contato conosco!</h1>
          <h4>(14) 98156-1881</h4>
          <h4>(14) 98102-9464</h4>
          <div class="container-redes">
            <a href="https://wa.me/5514981561881?text=Quero estudar na Palavrear!"><div class="circulo circulo-inscricao"><i class="fa-brands fa-whatsapp"></i></div></a>
            <a href="https://www.instagram.com/escolapalavrear/"><div class="circulo circulo-inscricao"><i class="fa-brands fa-instagram"></i></div></a>
            <a href="https://www.facebook.com/escolapalavrear/?locale=pt_BR"><div class="circulo circulo-inscricao"><i class="fa-brands fa-facebook"></i></div></a>
            <a href="mailto:escolapalavrear@gmail.com?subject=Quero estudar na Palavrear!"><div class="circulo circulo-inscricao"><i class="fa-solid fa-envelope"></i></div></a>
            <a href="https://wa.me/5514981029464?text=Quero estudar na Palavrear!"><div class="circulo circulo-inscricao"><i class="fa-brands fa-whatsapp"></i></div></a>
          </div>
          <a href="{{ route('login', ['erro' => 6]) }}"><div class="entrar-inscricao">Entrar</div></a>
        </div>
      </div>
    </section>

    <h1 class="titulo" id="ancora5">Seja aprovado nos principais vestibulares!</h1>
    <section class="logos">
        <div class="logo_items">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/68/Logotipo_FUVEST.png">
            <img src="https://cdn.direcaoconcursos.com.br/uploads/2021/08/Vunesp.jpg">
            <img src="https://www.famerp.br/wp-content/uploads/2022/08/logo-famerp.png">
            <img src="https://www.famema.br/institucional/documentos/marcas/famemacor.gif">
            <img src="https://upload.wikimedia.org/wikipedia/pt/thumb/b/b2/UNICAMP_logo.svg/1932px-UNICAMP_logo.svg.png">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSJHNo_oJZ6GQIo33T-gSnmcTefxdhaguxK-g&s">
            <img src="https://dci.unifesp.br/images/marca_unifesp/Unifesp_secundaria_policromia_RGB.png">
        </div>

        <div class="logo_items">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/68/Logotipo_FUVEST.png">
            <img src="https://cdn.direcaoconcursos.com.br/uploads/2021/08/Vunesp.jpg">
            <img src="https://www.famerp.br/wp-content/uploads/2022/08/logo-famerp.png">
            <img src="https://www.famema.br/institucional/documentos/marcas/famemacor.gif">
            <img src="https://upload.wikimedia.org/wikipedia/pt/thumb/b/b2/UNICAMP_logo.svg/1932px-UNICAMP_logo.svg.png">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSJHNo_oJZ6GQIo33T-gSnmcTefxdhaguxK-g&s">
            <img src="https://dci.unifesp.br/images/marca_unifesp/Unifesp_secundaria_policromia_RGB.png">
        </div>
    </section>

    <h1 class="titulo" id="ancora6">Nossa Plataforma</h1>
    <div class="container-plataforma">
    <section class="plataforma">
        <article class="info-plataforma">

        <div class="container-info-plataforma">
                <div class="circulo-plataforma"><i class="fa-solid fa-pencil"></i></div>
                <div class="texto">
                    <h1>Correção Especializada</h1>
                    <p>Feedback detalhado e personalizado com base nos critérios dos principais vestibulares, ajudando o aluno a evoluir em cada competência.</p>
                </div>
            </div>

            <div class="container-info-plataforma">
                <div class="circulo-plataforma"><i class="fa-solid fa-landmark"></i></div>
                <div class="texto">
                    <h1>Banco de Repertórios </h1>
                    <p>Repertórios prontos e organizados por temas, com exemplos práticos de uso em redações para enriquecer os argumentos de forma facilitada.</p>
                </div>
            </div>

            <div class="container-info-plataforma">
                <div class="circulo-plataforma"><i class="fa-regular fa-circle-question"></i></div>
                <div class="texto">
                    <h1>Banco de Questões</h1>
                    <p>Questões organizadas por categoria (gramática, interpretação de texto e literatura), por vestibular e por assunto abordado, facilitando a prática direcionada.</p>
                </div>
            </div>

        </article>

        <article class="imagem-plataforma"><img src="{{ asset('assets/img/celular.png') }}" alt=""></article>

        <article class="info-plataforma">

            <div class="container-info-plataforma">
                <div class="circulo-plataforma"><i class="fa-solid fa-folder"></i></div>
                <div class="texto">
                    <h1>Materiais</h1>
                    <p>Guias, documentos, grades, cartilhas e modelos de redação para aprimorar a escrita e o domínio das competências exigidas.</p>
                </div>
            </div>

            <div class="container-info-plataforma">
                <div class="circulo-plataforma"><i class="fa-solid fa-chart-line"></i></div>
                <div class="texto">
                    <h1>Estatísticas</h1>
                    <p>Gráficos interativos que analisam o desempenho do aluno conforme os temas e as bancas, ajudando-o a direcionar seu estudo.</p>
                </div>
            </div>

            <div class="container-info-plataforma">
                <div class="circulo-plataforma"><i class="fa-solid fa-calendar-days"></i></i></div>
                <div class="texto">
                    <h1>Planejamento Semanal</h1>
                    <p>Cronogramas personalizados com metas e temas semanais, para manter uma progressão e evolução constante do aluno.</p>
                </div>
            </div>

        </article>
    </section>
    </div>

    <h1 class="titulo" id="ancora7">Nossa Missão</h1>
    <div class="container-sobre-nos" id="fade">
    <section class="sobre-nos">
        <p>Ao longo desses anos, obtivemos êxito, por intermédio de nossos alunos e alunas, nas redações de vestibulinhos,  vestibulares e concursos. Ficamos imensamente realizados com a realização de tantos sonhos!
Venha você também fazer parte da Palavrear! 🧡</p>
        <div class="container-fade-img"><div class="fade-img"><img src="https://alumni.unesp.br/images/402655206/IMG-20220311-WA0024_1647090206658.jpg" alt=""></div></div>
    </section>
    </div>

    <h1 class="titulo" id="ancora8">Aprovações</h1>
    <section class="logos aprovacoes">

        <div class="logo_items aprovacoes_items">
            <img src="{{ asset('assets/img/rodo.png') }}">
            <img src="{{ asset('assets/img/ap1.png') }}">
            <img src="{{ asset('assets/img/ap2.png') }}">
            <img src="{{ asset('assets/img/ap3.png') }}">
            <img src="{{ asset('assets/img/ap4.png') }}">
            <img src="{{ asset('assets/img/ap5.png') }}">
            <img src="{{ asset('assets/img/ap6.png') }}">
            <img src="{{ asset('assets/img/ap7.png') }}">
            <img src="{{ asset('assets/img/ap8.png') }}">
        </div>

        <div class="logo_items aprovacoes_items">
        <img src="{{ asset('assets/img/rodo.png') }}">
            <img src="{{ asset('assets/img/ap1.png') }}">
            <img src="{{ asset('assets/img/ap2.png') }}">
            <img src="{{ asset('assets/img/ap3.png') }}">
            <img src="{{ asset('assets/img/ap4.png') }}">
            <img src="{{ asset('assets/img/ap5.png') }}">
            <img src="{{ asset('assets/img/ap6.png') }}">
            <img src="{{ asset('assets/img/ap7.png') }}">
            <img src="{{ asset('assets/img/ap8.png') }}">
        </div>

    </section>

    <h1 class="titulo" id="ancora9">Nossa Equipe</h1>
    <section class="nossa-equipe">
        <div class="card">
            <img src="{{ asset('assets/img/paola.png') }}" alt="" class="hover">
            <div class="texto-card">
                <h1>Paola Leutwiler Moraes</h1>
                <p>Professora da Escola Palavrear</p>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('assets/img/diego.png') }}" alt="" class="hover">
            <div class="texto-card">
                <h1>Diego Moraes</h1>
                <p>Professor da Escola Palavrear</p>
            </div>
        </div>
    </section>

    <!-- <section class="publicacoes-recentes">

        <div class="column">
            <h2>Título do Artigo</h2>
            <img src="https://www.ncsaude.com.br/wp-content/uploads/2023/01/Design-sem-nome-45.png" alt="Imagem do Artigo">
            <button type="button" class="saiba-mais">Saiba mais</button>
        </div>
        <div class="column">
            <h2>Título do Artigo</h2>
            <img src="https://www.ncsaude.com.br/wp-content/uploads/2023/01/Design-sem-nome-45.png" alt="Imagem do Artigo">
            <button type="button" class="saiba-mais">Saiba mais</button>
        </div>
        <div class="column">
            <h2>Título do Artigo</h2>
            <img src="https://www.ncsaude.com.br/wp-content/uploads/2023/01/Design-sem-nome-45.png" alt="Imagem do Artigo">
            <button type="button" class="saiba-mais">Saiba mais</button>
        </div>
    </section> -->

    <footer class="footer">
      <div class="container">
        <div class="row">
          <!-- <div class="footer-col">
            <div class="comtainer-img"><img src="logo.png" alt=""></div>
          </div> -->
          <div class="footer-col">
            <h4>Menu</h4>
            <ul id="menu-footer">
              <li><a href="#ancora1">A Palavrear</a></li>
              <li><a href="#ancora2">Nossa missão</a></li>
              <li><a href="#ancora3">Sobre nós</a></li>
              <li><a href="#ancora4">Insrição</a></li>
              <li><a href="#ancora5">Vestibulares</a></li>
              <li><a href="#ancora6">Nossa plataforma</a></li>
              <li><a href="#ancora7">Nosso objetivo</a></li>
              <li><a href="#ancora8">Aprovações</a></li>
              <li><a href="#ancora9">Nossa equipe</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h4>Contato</h4>
            <ul>
                <li><a href="#">(14) 98156-1881</a></li>
                <li><a href="#">(14) 98102-9464</a></li>
                <li><a href="mailto:escolapalavrear@gmail.com?subject=Quero estudar na Palavrear!">escolapalavrear@gmail.com</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h4>Nossas Redes</h4>
            <div class="social-links">
                <a href="https://wa.me/5514981561881?text=Quero estudar na Palavrear!"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="https://www.instagram.com/escolapalavrear/"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.facebook.com/escolapalavrear/?locale=pt_BR"><i class="fa-brands fa-facebook"></i></a>
                <a href="mailto:escolapalavrear@gmail.com?subject=Quero estudar na Palavrear!"><i class="fa-solid fa-envelope"></i></a>
                <a href="https://wa.me/5514981029464?text=Quero estudar na Palavrear!"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>

</body>
</html>


