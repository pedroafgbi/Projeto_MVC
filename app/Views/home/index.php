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
                    <div class="d-flex justify-content-center">
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

<!-- Quizzes -->
<section class="py-5" id="quizzes">
    <div class="container px-5">
        <h2 class="fw-bold mb-4">Quizzes</h2>

        <?php if (empty($quizzes)): ?>
            <p class="text-muted">Nenhum quiz disponível no momento.</p>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($quizzes as $quiz): ?>
                    <div class="col-12">
                        <article class="card shadow-sm quiz-card">
                            <div class="card-body p-4">
                                <h3 class="h4 fw-bold">
                                    <?= e($quiz['titulo']) ?>
                                </h3>

                                <?php if (!empty($quiz['descricao'])): ?>
                                    <p class="text-muted">
                                        <?= e($quiz['descricao']) ?>
                                    </p>
                                <?php endif; ?>

                                <?php if (!empty($quiz['perguntas'])): ?>
                                    <div class="quiz-intro">
                                        <p>
                                            <?= count($quiz['perguntas']) ?>
                                            <?= count($quiz['perguntas']) === 1 ? 'pergunta' : 'perguntas' ?>
                                        </p>
                                        <button type="button"
                                                class="btn btn-primary quiz-start">
                                            Iniciar Quiz
                                        </button>
                                    </div>

                                    <div class="quiz-play" hidden>
                                        <p class="quiz-progress text-muted"
                                           aria-live="polite"></p>

                                        <ol class="quiz-questions">
                                            <?php foreach ($quiz['perguntas'] as $index => $pergunta): ?>
                                                <li class="quiz-question"
                                                    <?= $index === 0 ? '' : 'hidden' ?>>
                                                    <fieldset>
                                                        <legend class="h5 fw-bold">
                                                            <?= e($pergunta['enunciado']) ?>
                                                        </legend>

                                                        <?php foreach ($pergunta['alternativas'] as $alternativaIndex => $alternativa): ?>
                                                            <label class="form-check mb-2">
                                                                <input class="form-check-input"
                                                                       type="radio"
                                                                       name="quiz-<?= e($quiz['id_quiz']) ?>-pergunta-<?= $index ?>"
                                                                       data-correct="<?= $alternativa['correta'] ? '1' : '0' ?>">
                                                                <span class="form-check-label">
                                                                    <?= e($alternativa['texto']) ?>
                                                                </span>
                                                            </label>
                                                        <?php endforeach; ?>
                                                    </fieldset>
                                                </li>
                                            <?php endforeach; ?>
                                        </ol>

                                        <p class="quiz-feedback"
                                           aria-live="polite"></p>
                                        <button type="button"
                                                class="btn btn-success quiz-next"
                                                disabled>
                                            Responder
                                        </button>
                                    </div>

                                    <div class="quiz-result" aria-live="polite" hidden>
                                        <h4 class="h5 fw-bold">Quiz finalizado!</h4>
                                        <p class="quiz-score"></p>
                                        <button type="button"
                                                class="btn btn-outline-primary quiz-restart">
                                            Refazer Quiz
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<script src="<?= e(asset('js/quiz.js')) ?>" defer></script>
