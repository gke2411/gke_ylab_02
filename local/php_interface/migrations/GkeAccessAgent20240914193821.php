<?php

namespace Sprint\Migration;


class GkeAccessAgent20240914193821 extends Version
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
        $helper->Agent()->saveAgent(array (
  'MODULE_ID' => 'gke.access',
  'USER_ID' => NULL,
  'SORT' => '100',
  'NAME' => 'Gke\Access\AccessClass::gkeAccessDisableElement();',
  'ACTIVE' => 'Y',
  'NEXT_EXEC' => '14.09.2024 22:33:00',
  'AGENT_INTERVAL' => '120',
  'IS_PERIOD' => 'Y',
  'RETRY_COUNT' => '0',
));
    }

    public function down(){
		$helper = $this->getHelperManager();
		$ok = $helper->Agent()->deleteAgent("gke.access", "Gke\Access\AccessClass::gkeAccessDisableElement();");
		
        if ($ok) {
            $this->outSuccess('Агент удален');
        } else {
            $this->outError('Ошибка удаления агента');
        }
    }
}
