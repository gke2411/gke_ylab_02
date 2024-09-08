<?php

namespace Sprint\Migration;


class gkeAccessAgent20240908175303 extends Version
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
  'MODULE_ID' => '',
  'USER_ID' => NULL,
  'SORT' => '10',
  'NAME' => 'gkeAccessDisableElement();',
  'ACTIVE' => 'Y',
  'NEXT_EXEC' => '08.09.2024 15:25:00',
  'AGENT_INTERVAL' => '60',
  'IS_PERIOD' => 'Y',
  'RETRY_COUNT' => '0',
));
    }
    public function down(){
		$helper = $this->getHelperManager();
		$ok = $helper->Agent()->deleteAgent("", "gkeAccessDisableElement();");
		
        if ($ok) {
            $this->outSuccess('Агент удален');
        } else {
            $this->outError('Ошибка удаления агента');
        }
    }
}
