
<?php
// Incluye la librería al inicio del archivo
require_once 'LibreTranslate.php';

use WHMCS\Database\Capsule;

function libretranslate_knowledgebase_config() {
    return [
        'name' => 'LibreTranslate Knowledgebase',
        'description' => 'This module adds a multi-language button to the knowledgebase for automatic translation.',
        'version' => '1.0',
        'author' => 'Your Name',
        'fields' => [
            'apiKey' => [
                'FriendlyName' => 'API Key',
                'Type' => 'text',
                'Size' => '256',
                'Description' => 'Enter your LibreTranslate API Key',
            ],
            'serverUrl' => [
                'FriendlyName' => 'LibreTranslate URL',
                'Type' => 'text',
                'Size' => '256',
                'Description' => 'Enter your LibreTranslate server URL',
                'Default' => 'https://traductor.hostingsupremo.org/',
            ],
        ]
    ];
}

function libretranslate_knowledgebase_activate() {
    // Activation code here...
    return ['status' => 'success', 'description' => 'Module activated successfully.'];
}

function libretranslate_knowledgebase_deactivate() {
    // Deactivation code here...
    return ['status' => 'success', 'description' => 'Module deactivated successfully.'];
}

function libretranslate_knowledgebase_output($vars) {
    // Admin area output code here...
}

// Modifica la función translateText para obtener los valores de configuración
/*function translateText($text, $language) {
    // Obtener la configuración del módulo
    $moduleConfig = getLibreTranslateConfig();

    $apiBase = $moduleConfig['serverUrl'];
    $apiKey = $moduleConfig['apiKey'];

    $libreTranslate = new Jefs42\LibreTranslate($apiBase);
    $libreTranslate->setApiKey($apiKey);
    
    try {
        return $libreTranslate->Translate($text, 'en', $language);
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}*/

// Función para obtener la configuración del módulo
/*function getLibreTranslateConfig() {
    $result = select_query(
        'tbladdonmodules',
        'value',
        ["module" => "libretranslate_knowledgebase", "setting" => ["serverUrl", "apiKey"]]
    );

    $config = [];
    while ($data = mysql_fetch_array($result)) {
        if ($data['setting'] == 'serverUrl') {
            $config['serverUrl'] = $data['value'];
        } elseif ($data['setting'] == 'apiKey') {
            $config['apiKey'] = $data['value'];
        }
    }

    return $config;
}*/


function libretranslate_knowledgebase_clientarea($vars) {
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
    $output = [];

    switch ($action) {
        case 'translate':
            $text = $_POST['text'];
            $language = $_POST['language'];
            $translatedText = translateText($text, $language);
            $output = [
                'translatedText' => $translatedText
            ];
            break;
    }

    return $output;
}