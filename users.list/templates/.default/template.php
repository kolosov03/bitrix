<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if ($arParams['AJAX'] != 'Y') {?>
<div id="ajaxUsers">
<? } ?>
    <div class="row">
    <?
    foreach ($arResult['USERS'] as $arUser) {
        ?>
        <div class="col-12">
            <div class="name"><?=$arUser['LOGIN']?></div>
            <div class="mail"><?=$arUser['EMAIL']?></div>
            <hr>
        </div>
        <?
    }
    ?>
    </div>
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.pagenavigation",
        "",
        array(
            "NAV_OBJECT" => $arResult["NAV"],
            "SEF_MODE" => "N",
        ),
        $component
    );
    
if ($arParams['AJAX'] != 'Y') {?>
</div>
<div class='export-btns'>
    <a class="btn btn-info" data-format="xml">Экспорт в XML</a>
    <a class="btn btn-info" data-format="csv">Экспорт в CSV</a>
</div>
<script type="text/javascript">
    ajaxPath = '<?=$componentPath?>/ajax.php';
    exportPath = '<?=$componentPath?>/export.php';
	templateName = '<?=$templateName?>';
	arParams     =  <?=CUtil::PhpToJSObject ($arParams)?>;
</script>

<? } ?>
