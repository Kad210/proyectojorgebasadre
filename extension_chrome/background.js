/* ARCHIVO: background.js (con pistas de depuración) */
chrome.tabs.onUpdated.addListener((tabId, changeInfo, tab) => {
    // Nos aseguramos de que la URL exista y la pestaña se esté cargando
    if (changeInfo.status === 'loading' && tab.url && tab.url.startsWith('http')) {
        console.log("Revisando URL:", tab.url); // Pista 1: ¿Se está ejecutando?

        chrome.storage.sync.get(['apiKey'], async (result) => {
            if (result.apiKey) {
                console.log("API Key encontrada:", result.apiKey); // Pista 2: ¿Tenemos la llave?
                try {
                    const response = await fetch('http://127.0.0.1:8000/api/check-url', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            api_key: result.apiKey,
                            url: tab.url
                        })
                    });
                    if (!response.ok) {
                        console.error("Error de la API. Estado:", response.status); // Pista 3: ¿La API respondió bien?
                        return;
                    }

                    const data = await response.json();
                    console.log("Respuesta de la API:", data); // Pista 4: ¿Qué dijo la API?

                    // Si la respuesta dice que está bloqueado, redirigimos
                    if (data.blocked === true) {
                        console.log("¡BLOQUEANDO SITIO!"); // Pista 5: ¿Se intentó bloquear?
                        chrome.tabs.update(tabId, { url: 'blocked.html' });
                    }

                } catch (error) {
                    console.error('Error de Conexión. ¿Está `php artisan serve` corriendo?', error);
                }
            } else {
                console.log("No se encontró API Key. Configúrala en el popup.");
            }
        });
    }
});