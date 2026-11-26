document.querySelectorAll('.quiz-card').forEach(function (card) {
    var intro = card.querySelector('.quiz-intro');
    var play = card.querySelector('.quiz-play');
    var result = card.querySelector('.quiz-result');
    var questions = Array.from(card.querySelectorAll('.quiz-question'));
    var progress = card.querySelector('.quiz-progress');
    var feedback = card.querySelector('.quiz-feedback');
    var nextButton = card.querySelector('.quiz-next');
    var index = 0;
    var score = 0;
    var answered = false;

    if (!intro || !play || !result || questions.length === 0) {
        return;
    }

    function showQuestion() {
        questions.forEach(function (question, questionIndex) {
            question.hidden = questionIndex !== index;
        });

        progress.textContent =
            'Pergunta ' + (index + 1) + ' de ' + questions.length;
        feedback.textContent = '';
        nextButton.disabled = true;
        nextButton.textContent = 'Responder';
        answered = false;
    }

    intro.querySelector('.quiz-start').addEventListener('click', function () {
        intro.hidden = true;
        play.hidden = false;
        showQuestion();
    });

    questions.forEach(function (question) {
        question.addEventListener('change', function (event) {
            if (!answered && event.target.matches('input[type="radio"]')) {
                nextButton.disabled = false;
            }
        });
    });

    nextButton.addEventListener('click', function () {
        if (!answered) {
            var selected = questions[index].querySelector(
                'input[type="radio"]:checked'
            );

            if (!selected) {
                return;
            }

            answered = true;
            if (selected.dataset.correct === '1') {
                score += 1;
                feedback.textContent = 'Resposta correta!';
            } else {
                feedback.textContent = 'Resposta incorreta.';
            }

            questions[index].querySelectorAll('input[type="radio"]').forEach(
                function (input) {
                    input.disabled = true;
                }
            );

            nextButton.textContent =
                index === questions.length - 1
                    ? 'Ver resultado'
                    : 'Próxima pergunta';
            return;
        }

        index += 1;

        if (index === questions.length) {
            play.hidden = true;
            result.querySelector('.quiz-score').textContent =
                'Você acertou ' + score + ' de ' + questions.length + ' perguntas.';
            result.hidden = false;
            return;
        }

        showQuestion();
    });

    result.querySelector('.quiz-restart').addEventListener('click', function () {
        questions.forEach(function (question) {
            question.querySelectorAll('input[type="radio"]').forEach(
                function (input) {
                    input.checked = false;
                    input.disabled = false;
                }
            );
        });

        index = 0;
        score = 0;
        result.hidden = true;
        intro.hidden = false;
    });
});
