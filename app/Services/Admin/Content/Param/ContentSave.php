<?php namespace App\Services\Admin\Content\Param;

use App\Services\Admin\AbstractParam;

/**
 * 文章操作有关的参数容器，固定参数，方便分离处理。
 *
 * @author jiang <mylampblog@163.com>
 */
class ContentSave extends AbstractParam
{
    protected $name;

    protected $subtitle;

    protected $other;

    protected $content;

    protected $status;


}
