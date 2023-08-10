document.addEventListener('DOMContentLoaded', function() {
    const languageSelector = document.getElementById('languageSelector');
    
    if (languageSelector) {
        languageSelector.addEventListener('change', function() {
            const selectedLanguage = this.value;
console.log("Cambio de idioma detectado");
            // Traducir títulos y descripciones de las categorías
            const categoryTitles = document.querySelectorAll('.kb-category .h5');
            const categoryDescriptions = document.querySelectorAll('.kb-category .text-muted');

            categoryTitles.forEach((title, index) => {
                const contentToTranslate = title.innerText;
                translateAndReplace(contentToTranslate, selectedLanguage, title);

                const description = categoryDescriptions[index];
                const descriptionContent = description.innerText;
                translateAndReplace(descriptionContent, selectedLanguage, description);
            });

            // Traducir títulos de los artículos más vistos
            const articleTitles = document.querySelectorAll('.kb-article-item');
            articleTitles.forEach(title => {
                const contentToTranslate = title.innerText;
                translateAndReplace(contentToTranslate, selectedLanguage, title);
            });
        });
    }
});
function translateAndReplace(content, language, element) {
    console.log("Intentando realizar la solicitud AJAX...");
    console.log("webRoot:", webRoot);

    fetch(`${webRoot}/modules/addons/libretranslate_knowledgebase/`)
    .then(response => {
        console.log("Respuesta recibida:", response);
        return response.json();
    })
    .then(data => {
        console.log("Datos recibidos:", data);
    })
    .catch(error => {
        console.log("Error al realizar la solicitud:", error);
    });
}
document.getElementById('translateToEnglish').addEventListener('click', function() {
    console.log("Intentando traducir al inglés...");
    translateAndReplace(/* parámetros relevantes */);
});

document.getElementById('translateToSpanish').addEventListener('click', function() {
    console.log("Intentando traducir al español...");
    translateAndReplace(/* parámetros relevantes */);
});
