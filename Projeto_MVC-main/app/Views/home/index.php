<header class="eco-hero py-5">
    <div class="container px-5">
        <div class="row gx-5 align-items-center">
            <div class="col-lg-7">
                <div class="eco-hero-content my-5">
                    <span class="eco-kicker"><i class="bi bi-globe-americas"></i> Nosso planeta, nossas escolhas</span>
                    <h1 class="display-4 fw-bolder text-white mb-3">
                        Educação ambiental e consumo consciente
                    </h1>
                    <p class="lead fw-normal text-white-50 mb-4 mx-0">
                        Aprenda como as nossas escolhas do dia a dia afetam o meio ambiente
                        e descubra hábitos mais sustentáveis.
                    </p>
                    <div class="d-grid gap-3 d-sm-flex">
                        <a class="btn eco-btn-light btn-lg px-4 me-sm-3"
                           href="<?= e(url('user/profile')) ?>"><i class="bi bi-person-heart"></i> Meu perfil</a>
                        <a class="btn btn-outline-light btn-lg px-4" href="#sobre">Saiba mais</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="eco-planet" aria-hidden="true">
                    <span class="eco-orbit orbit-one"></span>
                    <span class="eco-orbit orbit-two"></span>
                    <i class="bi bi-globe-americas eco-planet-icon"></i>
                    <i class="bi bi-leaf-fill eco-float-leaf leaf-one"></i>
                    <i class="bi bi-droplet-fill eco-float-leaf leaf-two"></i>
                    <i class="bi bi-recycle eco-float-leaf leaf-three"></i>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="py-5" id="sobre">
    <div class="container px-5 my-5">
        <div class="row gx-5 align-items-start">
            <div class="col-lg-4 mb-5 mb-lg-0 eco-section-heading">
                <span class="eco-section-label"><i class="bi bi-seedling"></i> Conhecimento que transforma</span>
                <h2 class="fw-bolder mb-3">Pequenas escolhas, grande impacto.</h2>
                <p class="text-muted">
                    A educação ambiental ajuda a entender como nossos hábitos influenciam
                    os recursos naturais e como podemos viver de forma mais responsável.
                </p>
            </div>
            <div class="col-lg-8">
                <div class="row gx-5 row-cols-1 row-cols-md-2">
                    <div class="col mb-5 h-100">
                        <article class="eco-topic-card">
                            <div class="feature eco-topic-icon text-white mb-3" aria-label="Educação ambiental">
                                <i class="bi bi-book-half"></i>
                            </div>
                            <h2 class="h5">Educação ambiental</h2>
                            <p class="mb-0">
                                Valoriza a preservação da biodiversidade, dos rios, das florestas
                                e de todos os recursos naturais que sustentam a vida.
                            </p>
                        </article>
                    </div>
                    <div class="col mb-5 h-100">
                        <article class="eco-topic-card">
                            <div class="feature eco-topic-icon text-white mb-3" aria-label="Consumo consciente">
                                <i class="bi bi-bag-check"></i>
                            </div>
                            <h2 class="h5">Consumo consciente</h2>
                            <p class="mb-0">
                                Antes de comprar, pergunte: eu preciso? Posso reutilizar?
                                O produto é durável e de origem responsável?
                            </p>
                        </article>
                    </div>
                    <div class="col mb-5 mb-md-0 h-100">
                        <article class="eco-topic-card">
                            <div class="feature eco-topic-icon text-white mb-3" aria-label="Economia de recursos">
                                <i class="bi bi-droplet"></i>
                            </div>
                            <h2 class="h5">Economia de recursos</h2>
                            <p class="mb-0">
                                Fechar torneiras, reduzir o uso de energia e evitar alimentos
                                descartados são atitudes simples e importantes.
                            </p>
                        </article>
                    </div>
                    <div class="col h-100">
                        <article class="eco-topic-card">
                            <div class="feature eco-topic-icon text-white mb-3" aria-label="Destinação correta">
                                <i class="bi bi-recycle"></i>
                            </div>
                            <h2 class="h5">Destinação correta</h2>
                            <p class="mb-0">
                                Separar os resíduos, conhecer a coleta seletiva e dar preferência
                                à reutilização prolongam o ciclo dos materiais.
                            </p>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="eco-five-r py-5">
    <div class="container px-5">
        <div class="text-center mb-5">
            <span class="eco-section-label"><i class="bi bi-arrow-repeat"></i> Método dos 5 R's</span>
            <h2 class="fw-bolder">Um caminho para consumir melhor</h2>
            <p class="text-muted mb-0">Pequenas mudanças de rotina ajudam a reduzir o impacto ambiental.</p>
        </div>
        <div class="row g-4">
            <div class="col-6 col-lg">
                <div class="eco-r-card">
                    <span>1</span><i class="bi bi-hand-thumbs-down"></i>
                    <h3>Recusar</h3><p>Evite produtos desnecessários e embalagens descartáveis.</p>
                </div>
            </div>
            <div class="col-6 col-lg">
                <div class="eco-r-card">
                    <span>2</span><i class="bi bi-arrow-repeat"></i>
                    <h3>Reduzir</h3><p>Consuma menos e desperdice menos água, energia e alimentos.</p>
                </div>
            </div>
            <div class="col-6 col-lg">
                <div class="eco-r-card">
                    <span>3</span><i class="bi bi-arrow-clockwise"></i>
                    <h3>Reutilizar</h3><p>Dê novos usos a objetos antes de descartá-los.</p>
                </div>
            </div>
            <div class="col-6 col-lg">
                <div class="eco-r-card">
                    <span>4</span><i class="bi bi-recycle"></i>
                    <h3>Reciclar</h3><p>Separe corretamente materiais que podem retornar ao ciclo.</p>
                </div>
            </div>
            <div class="col-12 col-lg">
                <div class="eco-r-card">
                    <span>5</span><i class="bi bi-arrow-through-heart"></i>
                    <h3>Repensar</h3><p>Analise escolhas e revise hábitos para fazer diferente.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="eco-action py-5">
    <div class="container px-5">
        <div class="eco-action-card rounded-3 p-4 p-sm-5">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="eco-action-kicker"><i class="bi bi-lightning-charge"></i> Comece hoje</span>
                    <h2 class="fw-bolder text-white mb-3">Três atitudes para praticar agora</h2>
                    <div class="row g-3 text-white">
                        <div class="col-md-4"><div class="eco-action-tip"><i class="bi bi-cup-straw"></i><span>Evite descartáveis</span></div></div>
                        <div class="col-md-4"><div class="eco-action-tip"><i class="bi bi-lightbulb"></i><span>Apague a luz</span></div></div>
                        <div class="col-md-4"><div class="eco-action-tip"><i class="bi bi-trash3"></i><span>Separe o lixo</span></div></div>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <a class="btn btn-outline-light btn-lg px-4"
                       href="<?= e(url('user/profile')) ?>"><i class="bi bi-person-circle"></i> Acessar meu perfil</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container px-5 mb-5">
        <aside class="bg-primary bg-gradient rounded-3 p-4 p-sm-5">
            <div class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
                <div class="mb-4 mb-xl-0">
                    <div class="fs-3 fw-bold text-white"><i class="bi bi-stars me-2"></i>Faça parte do projeto.</div>
                    <div class="text-white-50">Aprenda, pratique e compartilhe atitudes sustentáveis.</div>
                </div>
                <div class="ms-xl-4">
                    <a class="btn btn-outline-light btn-lg px-4"
                       href="<?= e(url('user/profile')) ?>">Acessar meu perfil</a>
                </div>
            </div>
        </aside>
    </div>
</section>
