<?
namespace Gke\Vehicle;

use Bitrix\Main\Loader;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\DatetimeField;
use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Type;

class VehicleColorTable extends DataManager
{
	public static function getTableName()
	{
		return 'gke_vehiclecolor';
	}

	public static function getMap()
	{
		return array(
			new IntegerField('ID', array(
                'autocomplete' => true,
                'primary' => true
            )),
			new StringField('CODE', array(
				'required' => true,
				'title' => "Код"
			)),
			new StringField('NAME', array(
				'required' => true,
				'title' => "Имя",
			)),
			new ReferenceField("COLOR", 'Gke\Vehicle\VehicleItems',
				array("=this.ID" => "ref.COLOR_ID"),
				//array('join_type' => 'INNER')
			),
		);
	}

}
?>