<?php

use WHMCS\Database\Capsule;

add_hook('ClientAreaPageKnowledgebase', 1, function($vars) {
    // Aquí puedes agregar código para modificar la página de la base de conocimientos antes de que se muestre al cliente.
    // Por ejemplo, puedes agregar variables adicionales que se pasarán a la plantilla.
});

add_hook('ClientAreaFooterOutput', 1, function($vars) {
    // Aquí puedes agregar código para modificar el pie de página de la base de conocimientos.
    // Por ejemplo, puedes agregar scripts adicionales que se cargarán en el pie de página.
});
