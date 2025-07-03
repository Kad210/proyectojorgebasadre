/* ARCHIVO: popup.js (CORREGIDO)
*/
document.addEventListener('DOMContentLoaded', function() {
    const apiKeyInput = document.getElementById('apiKey');
    const saveButton = document.getElementById('save');
    const statusDiv = document.getElementById('status');

    // Cargar la API Key guardada al abrir el popup
    chrome.storage.sync.get(['apiKey'], function(result) {
        if (result.apiKey) {
            apiKeyInput.value = result.apiKey;
        }
    });

    // Al hacer clic en Guardar...
    saveButton.addEventListener('click', function() {
        const apiKey = apiKeyInput.value.trim(); // Usar trim para eliminar espacios
        if (apiKey) {
            // Guarda la API Key en el almacenamiento de Chrome
            chrome.storage.sync.set({ apiKey: apiKey }, function() {
                statusDiv.textContent = '¡API Key guardada!';
                statusDiv.style.color = 'green';
                setTimeout(() => { statusDiv.textContent = ''; }, 2000);
            });
        } else {
            statusDiv.textContent = 'El campo no puede estar vacío.';
            statusDiv.style.color = 'red';
            setTimeout(() => { statusDiv.textContent = ''; }, 2000);
        }
    });
});