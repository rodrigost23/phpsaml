<?php
if (!defined('GLPI_ROOT')) {
    define('GLPI_ROOT', '../../..');
}

if (!empty($_POST['SAMLRequest'])) {
    $_GET['SAMLRequest'] = $_POST['SAMLRequest'];
}

$post = $_POST;
unset($_POST);

include(GLPI_ROOT . '/inc/includes.php');

require_once GLPI_ROOT . '/plugins/phpsaml/lib/xmlseclibs/xmlseclibs.php';
$libDir = GLPI_ROOT . '/plugins/phpsaml/lib/php-saml/src/Saml2/';

$folderInfo = scandir($libDir);

foreach ($folderInfo as $element) {
    if (is_file($libDir . $element) && (substr($element, -4) === '.php')) {
        require_once $libDir . $element;
    }
}

use OneLogin\Saml2\Utils;

$phpsaml = new PluginPhpsamlPhpsaml();

$phpsaml::auth();

try {
    $phpsaml::$auth->processSLO();
    $errors = $phpsaml::$auth->getErrors();
} catch (\Throwable $th) {
    $errors = [$th->getMessage()];
}

if (empty($errors)) {
    $phpsaml::glpiLogout();
} else {
    Toolbox::logInFile("php-errors", implode(', ', $errors) . "\n", true);
}

Utils::redirect($CFG_GLPI["url_base"]);
