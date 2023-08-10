document.addEventListener('DOMContentLoaded', function() {
    const languageSelector = document.getElementById('languageSelector');
    
    if (languageSelector) {
        languageSelector.addEventListener('change', function() {
            const selectedLanguage = this.value;

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
    fetch('{$WEB_ROOT}/modules/addons/libretranslate_knowledgebase/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=translate&text=${encodeURIComponent(content)}&language=${language}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.translatedText) {
            element.innerText = data.translatedText;
        }
    });
}
