# bitrix

# users.list
компонент вывода списка пользователей с постраничной навигацией, для верной работы экспорта пользователей надо поправить 
CBitrixComponent::includeComponentClass("dev:users.list"); в файле export.php.
Заменить "dev" на название папки в которой будет лежать компонент
