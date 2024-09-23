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
		"ELEMENT_FILTER" => [
			"NAME" => "Фильтр элементов",
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
		"FILTER_COLOR" => [
			"PARENT" => "ELEMENT_FILTER",
			"NAME" => "Цвет",
			"TYPE" => "STRING",
		],
		"FILTER_COMMERCIAL" => [
			"PARENT" => "ELEMENT_FILTER",
			"NAME" => "Коммерческий",
			"TYPE" => "STRING",
		],
		"FILTER_CAPACITY" => [
			"PARENT" => "ELEMENT_FILTER",
			"NAME" => "Грузоподъёмность",
			"TYPE" => "INTEGER",
		],
	]
];
