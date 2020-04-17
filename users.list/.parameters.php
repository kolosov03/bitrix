<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;

if(!Loader::includeModule('iblock'))
	return;

$arComponentParameters = array(
	"GROUPS" => array(
    ),
    "PARAMETERS" => array(
        "USERS_COUNT" => array(
			"PARENT" => "BASE",
			"NAME" => Loc::getMessage('COUNT_USERS_PAGE'),
			"TYPE" => "STRING",
			"DEFAULT" => "20",
        ),
        "CACHE_TIME"  =>  array("DEFAULT"=>36000000),
    )
);

CIBlockParameters::AddPagerSettings(
	$arComponentParameters,
	Loc::getMessage("DESC_PAGER_USERS"), //$pager_title
	false, //$bDescNumbering
	true //$bShowAllParam
);

?>
