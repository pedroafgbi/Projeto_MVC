<!-- Cabeçalho (hero) -->
<header class="bg-dark py-5">
    <div class="container px-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <div class="my-5 text-center">
                    <h1 class="display-5 fw-bolder text-white mb-2">
                        Educação ambiental e consumo consciente
                    </h1>
                    <p class="lead fw-normal text-white-50 mb-4">
                        Aprenda como as nossas escolhas do dia a dia afetam o meio ambiente
                        e descubra hábitos mais sustentáveis.
                    </p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                        <a class="btn btn-primary btn-lg px-4 me-sm-3"
                           href="<?= e(url('user/profile')) ?>">Meu perfil</a>
                        <a class="btn btn-outline-light btn-lg px-4" href="#sobre">Saiba mais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Seção de destaques -->
<section class="py-5" id="sobre">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h2 class="fw-bolder mb-0">Pequenas escolhas, grande impacto.</h2>
            </div>
            <div class="col-lg-8">
                <div class="row gx-5 row-cols-1 row-cols-md-2">
                    <div class="col mb-5 h-100">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
                            <i class="bi bi-globe"></i>
                        </div>
                        <h2 class="h5">Educação ambiental</h2>
                        <p class="mb-0">
                            Conteúdos sobre preservação, reciclagem e uso consciente
                            dos recursos naturais.
                        </p>
                    </div>
                    <div class="col mb-5 h-100">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
                            <i class="bi bi-cart"></i>
                        </div>
                        <h2 class="h5">Consumo consciente</h2>
                        <p class="mb-0">
                            Como pensar antes de comprar: necessidade, durabilidade
                            e impacto de cada escolha.
                        </p>
                    </div>
                    <div class="col mb-5 mb-md-0 h-100">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
                            <i class="bi bi-droplet"></i>
                        </div>
                        <h2 class="h5">Menos desperdício</h2>
                        <p class="mb-0">
                            Hábitos simples que reduzem o desperdício de água e energia
                            em casa e na escola.
                        </p>
                    </div>
                    <div class="col h-100">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
                            <i class="bi bi-book"></i>
                        </div>
                        <h2 class="h5">Aprender juntos</h2>
                        <p class="mb-0">
                            Material de apoio para estudantes e professores
                            aprenderem e ensinarem em conjunto.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Chamada para ação -->
<section class="pb-5">
    <div class="container px-5 mb-5">
        <aside class="bg-primary bg-gradient rounded-3 p-4 p-sm-5">
            <div class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
                <div class="mb-4 mb-xl-0">
                    <div class="fs-3 fw-bold text-white">Faça parte do projeto.</div>
                    <div class="text-white-50">Acesse e atualize suas informações de cadastro.</div>
                </div>
                <div class="ms-xl-4">
                    <a class="btn btn-outline-light btn-lg px-4"
                       href="<?= e(url('user/profile')) ?>">Acessar meu perfil</a>
                </div>
            </div>
        </aside>
    </div>
</section>
