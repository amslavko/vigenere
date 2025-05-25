document.getElementById('cipherForm').addEventListener('submit', async function (e) {
  e.preventDefault();

  const text = document.getElementById('text').value;
  const key = document.getElementById('key').value;
  const action = document.querySelector('input[name="action"]:checked').value;

  if (!key.trim()) {
    document.getElementById('result').textContent = "Błąd: pusty klucz.";
    return;
  }

  const response = await fetch('encrypt.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `text=${encodeURIComponent(text)}&key=${encodeURIComponent(key)}&action=${action}`
  });

  const result = await response.text();
  document.getElementById('result').textContent = result;
});
