<?php

use WHMCS\Database\Capsule;

add_hook('ClientAreaPageKnowledgebase', 1, function($vars) {
    // Aquí puedes agregar código para modificar la página de la base de conocimientos antes de que se muestre al cliente.
    // Por ejemplo, puedes agregar variables adicionales que se pasarán a la plantilla.
});

add_hook('ClientAreaFooterOutput', 1, function($vars) {
    $webRoot = rtrim($vars['WEB_ROOT'], '/');
    return <<<HTML
    <script>
        var webRoot = "{$webRoot}";
    </script>
HTML;
});

