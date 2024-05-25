<?php namespace App\Services\Admin\ActionLog\Workflow\Index;

use App\Services\Admin\AbstractActionLog;
use App\Events\Admin\ActionLog;
use Request, Lang;

/**
 * 工作流操作日志
 *
 *  
 */
class Delete extends AbstractActionLog
{
    /**
     * Delete工作流时的日志记录
     */
    public function handler()
    {
        if( ! $this->isLog()) return false;
        $extDatas = $this->getExtDatas();
        if( ! isset($extDatas['workflowInfo']) or ! is_array($extDatas['workflowInfo']) or empty($extDatas['workflowInfo'])) return false;
        foreach($extDatas['workflowInfo'] as $value)
        {
            event(new ActionLog(Lang::get('actionlog.delete_workflow', ['name' => $value['name']])));
        }
    }
    
}
