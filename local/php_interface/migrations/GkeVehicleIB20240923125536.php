<?php

namespace Sprint\Migration;


class GkeVehicleIB20240923125536 extends Version
{
    protected $author = "admin";

    protected $description = "";

    protected $moduleVersion = "4.12.6";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Iblock()->saveIblockType(array (
  'ID' => 'gkevehicles',
  'SECTIONS' => 'Y',
  'EDIT_FILE_BEFORE' => '',
  'EDIT_FILE_AFTER' => '',
  'IN_RSS' => 'N',
  'SORT' => '500',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'ГКЕ Автомобили',
      'SECTION_NAME' => '',
      'ELEMENT_NAME' => '',
    ),
    'en' => 
    array (
      'NAME' => 'GKE Vehicles',
      'SECTION_NAME' => '',
      'ELEMENT_NAME' => '',
    ),
  ),
));
        $iblockId = $helper->Iblock()->saveIblock(array (
  'IBLOCK_TYPE_ID' => 'gkevehicles',
  'LID' => 
  array (
    0 => 's1',
  ),
  'CODE' => 'gkevehicle',
  'API_CODE' => NULL,
  'REST_ON' => 'N',
  'NAME' => 'Автомобили',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'LIST_PAGE_URL' => '#SITE_DIR#/gkevehicles/index.php?ID=#IBLOCK_ID#',
  'DETAIL_PAGE_URL' => '#SITE_DIR#/gkevehicles/detail.php?ID=#ELEMENT_ID#',
  'SECTION_PAGE_URL' => '#SITE_DIR#/gkevehicles/list.php?SECTION_ID=#SECTION_ID#',
  'CANONICAL_PAGE_URL' => '',
  'PICTURE' => NULL,
  'DESCRIPTION' => '',
  'DESCRIPTION_TYPE' => 'text',
  'RSS_TTL' => '24',
  'RSS_ACTIVE' => 'Y',
  'RSS_FILE_ACTIVE' => 'N',
  'RSS_FILE_LIMIT' => NULL,
  'RSS_FILE_DAYS' => NULL,
  'RSS_YANDEX_ACTIVE' => 'N',
  'XML_ID' => NULL,
  'INDEX_ELEMENT' => 'Y',
  'INDEX_SECTION' => 'Y',
  'WORKFLOW' => 'N',
  'BIZPROC' => 'N',
  'SECTION_CHOOSER' => 'L',
  'LIST_MODE' => '',
  'RIGHTS_MODE' => 'S',
  'SECTION_PROPERTY' => 'N',
  'PROPERTY_INDEX' => 'N',
  'VERSION' => '1',
  'LAST_CONV_ELEMENT' => '0',
  'SOCNET_GROUP_ID' => NULL,
  'EDIT_FILE_BEFORE' => '',
  'EDIT_FILE_AFTER' => '',
  'SECTIONS_NAME' => 'Разделы',
  'SECTION_NAME' => 'Раздел',
  'ELEMENTS_NAME' => 'Элементы',
  'ELEMENT_NAME' => 'Элемент',
  'EXTERNAL_ID' => NULL,
  'LANG_DIR' => '/',
  'IPROPERTY_TEMPLATES' => 
  array (
  ),
  'ELEMENT_ADD' => 'Добавить элемент',
  'ELEMENT_EDIT' => 'Изменить элемент',
  'ELEMENT_DELETE' => 'Удалить элемент',
  'SECTION_ADD' => 'Добавить раздел',
  'SECTION_EDIT' => 'Изменить раздел',
  'SECTION_DELETE' => 'Удалить раздел',
));
    $helper->Iblock()->saveGroupPermissions($iblockId, array (
  'administrators' => 'X',
  'everyone' => 'X',
));

    }
    public function down()
    {
        $helper = $this->getHelperManager();
        $ok = $helper->Iblock()->deleteIblockIfExists('gkevehicle');

        if ($ok) {
            $this->outSuccess('Инфоблок удален');
        } else {
            $this->outError('Ошибка удаления инфоблока');
        }
    }
}
