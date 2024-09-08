<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}
global $APPLICATION;

$arComponentParameters = [
	"GROUPS" => [
		"DATA_SOURCE" => [
			"NAME" => "Источник данных",
			"SORT" => 200
		],
		"CACHE" => [
			"NAME" => "Настройки кеширования",
			"SORT" => 900
		],
		"ELEMENT_STATUS" => [
			"NAME" => "Статус элемента",
			"SORT" => 200
		]
	],
	"PARAMETERS" => [
		"IBLOCK_CODE" => [
			"PARENT" => "DATA_SOURCE",
			"NAME" => "Код ИБ",
			"TYPE" => "STRING",
		],
		"CACHE_TIME" => ["DEFAULT"=>300],
		"ACTIVE" => [
			"PARENT" => "ELEMENT_STATUS",
			"NAME" => "Пользователь активен (Y|N)",
			"TYPE" => "STRING", //Y|N
			"DEFAULT" => "Y"
		]
		
	],
];
