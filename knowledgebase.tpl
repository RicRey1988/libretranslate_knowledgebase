{if isset($RSThemes['pages'][$templatefile]) && file_exists($RSThemes['pages'][$templatefile]['fullPath'])}
    {include file=$RSThemes['pages'][$templatefile]['fullPath']}
{else}
    <div class="search-box search-box-{$searchBoxStyle}">
        <form role="form" method="post" action="{routePath('knowledgebase-search')}">
            <div class="search-group">
                <div class="search-field search-field-lg">
                    <i class="search-field-icon lm lm-search"></i>
                    <input class="form-control form-control-lg" type="text" id="inputKnowledgebaseSearch" name="search" placeholder="{$LANG.howcanwehelp}" />
                </div>
                <button class="btn btn-lg btn-primary{if $searchBoxStyle == 'primary'}-faded{/if}" type="submit" id="btnKnowledgebaseSearch">{$LANG.search}</button>
            </div>
        </form>
    </div>
    <div class="section kb-categories">
        <div class="section-header">
            <h2 class="section-title">{$LANG.knowledgebasecategories} <!-- Agregar los botones de traducci�n -->
<button class="translateButton" data-language="en">English</button>
<button class="translateButton" data-language="es">Espa�ol</button>
<!-- Agregar otros botones para otros idiomas seg�n sea necesario --></h2>

        </div>
        <div class="section-body">
            {if $kbcats}
                <div class="list-group">
                    {foreach from=$kbcats name=kbcats item=kbcat}  
                        <a class="list-group-item has-icon" href="{routePath('knowledgebase-category-view', {$kbcat.id}, {$kbcat.urlfriendlyname})}">
                            <i class="list-group-item-icon lm lm-folder"></i>
                            <div class="list-group-item-body">
                                <div class="list-group-item-heading">{$kbcat.name} ({$kbcat.numarticles}){if $kbcat.editLink} <button data-lagom-href="{$kbcat.editLink}" class="btn btn-xs btn-default">{$LANG.edit}</button>{/if}</div> 
                                {if $kbcat.description}<p class="list-group-item-text">{$kbcat.description}</p>{/if}
                            </div>
                        </a>
                    {/foreach}
                </div>
            {else}
                <div class="message message-no-data">
                    <div class="message-image">
                        {include file="$template/includes/common/svg-icon.tpl" icon="article"}
                    </div>
                    <h6 class="message-title">{$LANG.knowledgebasenoarticles}</h6>
                </div>
            {/if}
        </div>
    </div>
    {if $kbmostviews}
        <div class="section kb-articles">
            <div class="section-header">
                <h2 class="section-title">{$LANG.knowledgebasepopular}</h2>
            </div>
            <div class="section-body">
                <div class="list-group">
                    {foreach from=$kbmostviews item=kbarticle}
                        <a class="list-group-item has-icon" href="{routePath('knowledgebase-article-view', {$kbarticle.id}, {$kbarticle.urlfriendlytitle})}">
                            <i class="list-group-item-icon ls ls-document"></i>
                            <div class="list-group-item-body">
                                <div class="list-group-item-heading">{$kbarticle.title}{if $kbarticle.editLink} <button data-lagom-href="{$kbarticle.editLink}" class="btn btn-default btn-xs">{$LANG.edit}</button>{/if}</div>
                                {if $kbarticle.article}<p class="list-group-item-text">{$kbarticle.article|truncate:100:"..."}</p>{/if}
                            </div>
                        </a>
                    {/foreach}
                </div>
            </div>
        </div>
    {/if}
{/if}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var translateButtons = document.querySelectorAll('.translateButton');
        translateButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var language = this.getAttribute('data-language');
                var contentElement = document.getElementById('contentArea');
                
                // Verificar si el elemento existe
                if (!contentElement) {
                    console.error('El elemento con ID "contentArea" no se encontr�.');
                    return;
                }

                var contentToTranslate = contentElement.innerText;

                // Hacer la llamada a LibreTranslate
                fetch('https://traductor.hostingsupremo.org/translate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer 62869fe6-5da3-4a8a-8b3e-fb29eac35f13'
                    },
                    body: JSON.stringify({
                        q: contentToTranslate,
                        source: 'en',
                        target: language
                    })
                })
                .then(response => response.json())
                .then(data => {
                    contentElement.innerText = data.translatedText;
                })
                .catch(error => {
                    console.error('Error al traducir el contenido:', error);
                });
            });
        });
    });
</script>