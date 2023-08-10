<?php
// Incluye la librería al inicio del archivo
require_once 'LibreTranslate.php';
require_once __DIR__ . '/../../../init.php';

use WHMCS\Database\Capsule;

// Modifica la función translateText para obtener los valores de configuración
function translateText($text, $language) {
    // Obtener la configuración del módulo
    $moduleConfig = getLibreTranslateConfig();

$apiBase = $moduleConfig['api_base'];
$apiKey = $moduleConfig['api_key'];

    $libreTranslate = new Jefs42\LibreTranslate($apiBase);
    $libreTranslate->setApiKey($apiKey);
    
    try {
        return $libreTranslate->Translate($text, 'en', $language);
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}

// Función para obtener la configuración del módulo
function getLibreTranslateConfig() {
    $config = [];

    $serverUrl = Capsule::table('tbladdonmodules')
        ->where('module', 'libretranslate_knowledgebase')
        ->where('setting', 'serverUrl')
        ->value('value');

    $apiKey = Capsule::table('tbladdonmodules')
        ->where('module', 'libretranslate_knowledgebase')
        ->where('setting', 'apiKey')
        ->value('value');

    $config['serverUrl'] = $serverUrl;
    $config['apiKey'] = $apiKey;

    return $config;
}

//$text = $_POST['text'];
//$language = $_POST['language'];
$text = isset($_POST['text']) ? $_POST['text'] : '';
$language = isset($_POST['language']) ? $_POST['language'] : '';
$translatedText = translateText($text, $language);

header('Content-Type: application/json');
echo json_encode(['translatedText' => $translatedText]);
