document.getElementById('cipherForm').addEventListener('submit', async function (e) {
  e.preventDefault();

  const form = e.target;
  const formData = new FormData(form);

  const response = await fetch('encrypt.php', {
    method: 'POST',
    body: formData
  });

  const result = await response.text();
  document.getElementById('result').textContent = result;
});
