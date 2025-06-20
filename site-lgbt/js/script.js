
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('formEvento');
  const mensagem = document.getElementById('mensagem');

  form.addEventListener('submit', function (e) {
    const eventoSelecionado = document.querySelector('input[name="evento"]:checked');
    if (!eventoSelecionado) {
      e.preventDefault();
      mensagem.textContent = "Selecione um evento antes de se inscrever.";
      mensagem.style.color = "red";
      return;
    }
    mensagem.textContent = "Enviando inscrição...";
    mensagem.style.color = "#555";
  });
});