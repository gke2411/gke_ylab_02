<?
namespace Gke\Vehicle;

use Bitrix\Main\Loader;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\BooleanField;
use Bitrix\Main\Entity\DatetimeField;
use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Main\Entity\Validator;
use Gke\Vehicle\VehicleColorTable;
/*
* Типы полей: 
* DatetimeField - дата и время
* DateField - дата
* BooleanField - логическое поле да/нет
* IntegerField - числовой формат
* FloatField - числовой дробный формат
* EnumField - список, можно передавать только заданные значения
* TextField - text
* StringField - varchar
*/


class VehicleItemsTable extends DataManager
{
	public static function getTableName()
	{
		return 'gke_vehicleitems';
	}

	public static function getMap()
	{
		return array(
			new IntegerField('ID', array(
                'autocomplete' => true,
                'primary' => true
            )),
			new StringField('VENDOR', array(
				'required' => true,
				'title' => "Марка",
			)),
			new StringField('MODEL', array(
				'required' => true,
				'title' => "Модель",
			)),
			new DatetimeField('YEAR', array(
				'required' => true,
				'title' => "Год выпуска",
			)),
			new IntegerField('CAPACITY', array(
				'required' => true,
				'title' => "Грузоподъёмность",
            )),
			new IntegerField("COLOR_ID", array(
				'required' => true,
				'title' => "Цвет",
			)),
			new ReferenceField("COLOR", 'Gke\Vehicle\VehicleColor',
				array("=this.COLOR_ID" => "ref.ID"),
				//array('join_type' => 'INNER')
			),
			/*new StringField('COMMERCIAL', array(
                'required' => true,
                'title' => "Коммерческий транспорт",
                'default_value' =>  "N",
		   )),*/
			new BooleanField('COMMERCIAL', array(
				"values" => array('N', 'Y'),
				'default_value' =>  "N",
				"required" => true,
				'title' => "Коммерческий транспорт",
				)
			),
		);
	}

}
?>