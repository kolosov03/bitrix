<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\UserTable;

CBitrixComponent::includeComponentClass("bitrix:main.pagenavigation");

class UsersList extends CBitrixComponent
{
    public function executeComponent() {
        global $USER;
        
        $nav = $this->initPageNavigation();
        if ($this->startResultCache(false, array(($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()), $nav))) {
            $this->arResult = $this->getUsers($nav);
            
            $this->includeComponentTemplate();
        }
    }

    protected function initPageNavigation(){
		$pageSize = $this->arParams["USERS_COUNT"];
		$nav = new Bitrix\Main\UI\PageNavigation("nav-users");
		$nav->allowAllRecords(true)->setPageSize($pageSize)->initFromUri();

		return $nav;
	}

    public function getUsers($nav) {
        $dbUsers = UserTable::getList(array(
            "select"=> array("*"),
            'count_total' => true,
			'offset' => $nav->getOffset(),
			'limit' => $nav->getLimit(),
        ));
        while ($arUser = $dbUsers->fetch()) {
            $arUsers[] = $arUser;
        }
    
        $nav->setRecordCount($dbUsers->getCount());

        $arResult = array(
            "USERS" => $arUsers,
            "NAV" => $nav
        );
        return $arResult;
    }
    public function getAllUsers() {
        $dbUsers = UserTable::getList(array(
            "select"=> array("*"),
        ));
        while ($arUser = $dbUsers->fetch()) {
            $arUsers[] = $arUser;
        }

        return $arUsers;
    }
}
