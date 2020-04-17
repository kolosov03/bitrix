<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

use \Bitrix\Main\IO;
use \Bitrix\Main\Application;
use \Bitrix\Main\XmlWriter;

CBitrixComponent::includeComponentClass("dev:users.list");

if (!empty($_GET['format'])) {
    switch($_GET['format']){
        case "xml":
            $filePath = '/upload/users_export/usersList.xml';
            $export = new XmlWriter(array(
                'file' => $filePath,
                'create_file' => true,
                'charset' => SITE_CHARSET,
                'lowercase' => true
            ));

            $arUsers = UsersList::getAllUsers();
            $export->openFile();
            $export->writeBeginTag('users');
            foreach ($arUsers as $arUsers) {
                $export->writeItem($arUsers, 'user');
            }
            $export->getErrors();
            $export->writeEndTag('users');
            $export->closeFile();
        break;
        case "csv":
            require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/classes/general/csv_data.php");

            function putDataToCSV($file,$array){
                $fields_type = 'R';
                $delimiter = ";";
                $csvFile = new CCSVData($fields_type, false);
                $csvFile->SetFieldsType($fields_type);
                $csvFile->SetDelimiter($delimiter);
                $csvFile->SetFirstHeader(true);
                $arrayFields = array();
                foreach (array_keys($array[current(array_keys($array))]) as $value)
                {
                    if(substr($value,0,1)=='~') continue;
                    $arrayFields[] = $value;
                }
                // запишем заголовки:
                $csvFile->SaveFile($file,$arrayFields);

                foreach ($array as $arValue){
                    $row = array();
                    foreach ($arrayFields as $arrayField)
                    {
                        $row[] = $arValue[$arrayField];
                    }
                    $csvFile->SaveFile($file,$row);
                }
            }

            $arUsers = UsersList::getAllUsers();

            $filePath = '/upload/users_export/usersList.csv';
            if (!IO\Directory::isDirectoryExists(Application::getDocumentRoot().'/upload/users_export/')) {
                IO\Directory::createDirectory(Application::getDocumentRoot().'/upload/users_export/');
            }
            $file = new IO\File(Application::getDocumentRoot().$filePath);
            $file->putContents(''); // очищаем файл

            putDataToCSV(Application::getDocumentRoot().$filePath, $arUsers);
        break;
    }
    echo $filePath;
}
