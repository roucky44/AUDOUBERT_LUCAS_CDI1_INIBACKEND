document.addEventListener('DOMContentLoaded', initCollection); 

async function initCollection() {
    const container = document.getElementById('api-renderer');
    
    try {
        container.innerHTML = `
            <div class="loader">
                <p>Chargement de votre collection...</p>
                <div class="spinner"></div>
            </div>
        `;

        const data = await fetchLOTRData();
        renderCharacters(data.docs, container);
        
    } catch (error) {
        container.innerHTML = `
            <div class="error">
                <p>Erreur de chargement</p>
                <small>${error.message}</small>
            </div>
        `;
    }
}

async function fetchLOTRData() {
    const response = await fetch('https://the-one-api.dev/v2/character', {
        headers: {
            'Authorization': 'Bearer KtFGls3XWxo_air2CXKc'
        }
    });
    
    if (!response.ok) {
        throw new Error(`Erreur ${response.status}: ${response.statusText}`);
    }
    
    return await response.json();
}

function renderCharacters(characters, container) {
    if (!characters || characters.length === 0) {
        container.innerHTML = '<p>Aucun personnage trouvé dans la collection.</p>';
        return;
    }

    const html = `
            <p class="count">${characters.length} personnages chargés</p>
        <table id="lotr-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Race</th>
                    <th>Genre</th>
                    <th>Naissance</th>
                    <th>Mort</th>
                    <th>Monde</th>
                    <th>Conjoint</thW>
                    <th>Wiki</th>
                </tr>
            </thead>
            <tbody>
                ${characters.map(char => `
                    <tr>
                        <td>${sanitizeHTML(char.name)}</td>
                        <td>${sanitizeHTML(char.race)}</td>
                        <td>${sanitizeHTML(char.gender)}</td>
                        <td>${sanitizeHTML(char.birth)}</td>
                        <td>${sanitizeHTML(char.death)}</td>
                        <td>${sanitizeHTML(char.realm)}</td>
                        <td>${sanitizeHTML(char.spouse)}</td>
                        <td>
                            ${char.wikiUrl 
                                ? `<a href="${sanitizeHTML(char.wikiUrl)}" target="_blank">📖</a>` 
                                : '—'}
                        </td>
                    </tr>
                `).join('')}
            </tbody>
        </table>
    `;

    container.innerHTML = html;
}

function sanitizeHTML(text) { // fonction pour éviter les injections.
    if (!text) return 'N/A';
    return text.toString()
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');
}




//      /!\ L'API (The.one.api) est une read only API !!! même avec token bearer mes requêtes POST von être rejeté. /!\
//      /!\ Elle ne fournis que des endpoints en GET uniquement. Ci dessous est la méthode que j'utilise en cas de POST autorisé./!\


document.getElementById('character-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = {
        name: document.getElementById('name').value,
        race: document.getElementById('race').value,
        gender: document.getElementById('gender').value,
        birth: "Inconnue",
        death: "Inconnue"
    };
    
    try {
        const response = await postCharacter(formData);
        showMessage('Personnage ajouté avec succès!', 'success');
        
    } catch (error) {
        showMessage(`Erreur: ${error.message}`, 'error');
    }
});


// FONCTION ASYNCHRONE POUR POST UN NOUVEAU PERSONNAGE
async function postCharacter(characterData) {
    const ApiUrl = 'https://the-one-api.dev/v2/character'; // je me connecte à l'API
    
    const response = await fetch(ApiUrl, { // je fais une requête POST
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer KtFGls3XWxo_air2CXKc'
        },
        body: JSON.stringify(characterData) // je converti les données en JSON
    });
    
    if (!response.ok) { // je vérifie que je recois une réponse
        throw new Error(`Erreur HTTP: ${response.status}`); // erreur si la réponse n'est pas ok
    }
    
    return await response.json();
}

function showMessage(text, type) { // fonction pour afficher le message ok ou pas ok
    const messageDiv = document.getElementById('form-message');
    messageDiv.textContent = text;
    messageDiv.style.background = type === 'success' ? '#d4edda' : '#f8d7da';
    messageDiv.style.color = type === 'success' ? '#155724' : '#721c24';
    
    setTimeout(() => {
        messageDiv.textContent = '';
        messageDiv.style.background = '';
    }, 5000);
}