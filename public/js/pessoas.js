document.addEventListener('DOMContentLoaded', () => {
    const formularios = document.querySelectorAll('.formulario-exclusao');

    formularios.forEach((formulario) => {
        formulario.addEventListener('submit', (event) => {
            const confirmou = window.confirm('Tem certeza que deseja excluir este cadastro?');

            if (!confirmou) {
                event.preventDefault();
            }
        });
    });
});
