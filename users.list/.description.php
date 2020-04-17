<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;

$arComponentDescription = array(
	"NAME" => Loc::getMessage("USERS_LIST_NAME"),
	"DESCRIPTION" => Loc::getMessage("USERS_LIST_DESCRIPTION"),
	"PATH" => array(
        "ID" => "users",
        "NAME" => Loc::getMessage("USERS_PATH_NAME")
	),
	"CACHE_PATH" => "Y"
);
?>
