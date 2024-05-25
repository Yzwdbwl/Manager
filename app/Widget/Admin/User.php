<?php

namespace App\Widget\Admin;

use App\Widget\Admin\AbstractBase;
use App\Services\Admin\Acl\Acl;

/**
 * 用户列表小组件
 *
 *  
 */
class User extends AbstractBase
{
    /**
     * 用户列表编辑操作
     *
     * @access public
     */
    public function edit($data)
    {
        $this->setCurrentAction('user', 'edit', 'foundation')->setData($data)->checkPermission(Acl::GROUP_LEVEL_TYPE_USER);
        $url = R('common', $this->module.'.'.$this->class.'.'.$this->function, ['id' => url_param_encode($data['id']) ]);
        $html = $this->hasPermission ?
                    '<a href="'.$url.'"><i class="fa fa-pencil"></i></a>'
                        : '<i class="fa fa-pencil" style="color:#ccc"></i>';
        return $html;
    }

    /**
     * 用户列表Delete操作
     *
     * @access public
     */
    public function delete($data)
    {
        $this->setCurrentAction('user', 'delete', 'foundation')->setData($data)->checkPermission(Acl::GROUP_LEVEL_TYPE_USER);
        $url = R('common', $this->module.'.'.$this->class.'.'.$this->function, ['id' => url_param_encode($data['id'])]);
        $html = $this->hasPermission ?
                    '<a href="javascript:ajaxDelete(\''.$url.'\', \'sys-list\', \'Are you sure to delete？\');"><i class="fa fa-trash-o"></i></a>'
                        : '<i class="fa fa-trash-o" style="color:#ccc"></i>';
        return $html;
    }

    /**
     * 用户列表权限操作
     *
     * @access public
     */
    public function acl($data)
    {
        $this->setCurrentAction('acl', 'user', 'foundation')->setData($data)->checkPermission(Acl::GROUP_LEVEL_TYPE_USER);
        $url = R('common', $this->module.'.'.$this->class.'.'.$this->function, ['id' => url_param_encode($data['id'])]);
        $html = $this->hasPermission ?
                    '<a href="'.$url.'"><i class="fa fa-user"></i></a>'
                        : '<i class="fa fa-user" style="color:#ccc"></i>';
        return $html;
    }

    /**
     * 面包屑中的按钮
     *
     * @access public
     */
    public function navBtn()
    {
        $this->setCurrentAction('user', 'add', 'foundation')->checkPermission(Acl::GROUP_LEVEL_TYPE_USER);
        $url = R('common', $this->module.'.'.$this->class.'.'.$this->function);
        $html = $this->hasPermission ?
                    '<div class="btn-group" style="float:right;"><a href="'.$url.'" title="Add new user" class="btn btn-primary btn-xs"><span aria-hidden="true" class="glyphicon glyphicon-plus"></span>Add new user</a></div>'
                        : '';
        return $html;
    }

}