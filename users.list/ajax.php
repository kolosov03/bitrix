<?

if (!isset($_POST['templateName']) || !is_string($_POST['templateName']))
	die();
    
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$_POST['arParams']['AJAX'] = 'Y';

$APPLICATION->RestartBuffer();
$APPLICATION->IncludeComponent('dev:users.list', $_POST['templateName'], $_POST['arParams']);
