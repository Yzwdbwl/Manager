<?php namespace App\Http\Controllers\Admin\Foundation;

use App\Models\Admin\Group;
use App\Models\User;
use Request, Lang, Session;
use App\Services\Admin\SC;
use App\Services\Admin\User\Process as UserActionProcess;
use App\Libraries\Js;
use App\Services\Admin\Acl\Acl;
use App\Http\Controllers\Admin\Controller;

/**
 *     
 *
 * 
 */
class UserController extends Controller
{
    /**
     *       
     *
     * @access public
     */
    public function index()
    {

        Session::flashInput(['http_referer' => Request::fullUrl()]);
        $userModel = new User(); $groupModel = new Group();
        $groupId = Request::input('gid');
        $userList = $userModel->getAllUser(['group_id' => $groupId]);
        $page = $userList->setPath('')->appends(Request::all())->render();
        $groupList = $groupModel->getAllGroup();

        return view('admin.user.index',
            compact('userList', 'groupList', 'page')
        );
    }

    /**
     *       
     *
     * @access public
     */
    public function add()
    {

        if(Request::method() == 'POST') return $this->saveUserInfoToDatabase();
        $groupModel = new Group();
        $groupId = SC::getLoginSession()->group_id;

        $groupInfo = $groupModel->getOneGroupById($groupId);
        $isSuperSystemManager = (new Acl())->isSuperSystemManager();
        if($isSuperSystemManager) $groupInfo['level'] = 0;
        $groupList = $groupModel->getGroupLevelLessThenCurrentUser($groupInfo['level']);
        $formUrl = R('common', 'foundation.user.add');
        return view('admin.user.add',
            compact('groupList', 'formUrl')
        );
    }

    /**
     *         
     *
     * @access private
     */
    private function saveUserInfoToDatabase()
    {
        $data = (array) Request::input('data');
        $data['add_time'] = time();
        $param = new \App\Services\Admin\User\Param\UserSave();
        $param->setAttributes($data);
        $manager = new UserActionProcess();
        if($manager->addUser($param))
        {

            return Js::locate(R('common', 'foundation.user.index'), 'parent');
        }
        return Js::error($manager->getErrorMessage());
    }

    /**
     * Delete  
     *
     * @access public
     */
    public function delete()
    {
        $id = Request::input('id');
        if( ! is_array($id))
        {
            if( ! $id = url_param_decode($id)) return responseJson(Lang::get('common.action_error'));
            $id = array($id);
        }
        $id = array_map('intval', $id);
        $userModel = new User();
        $userInfos = $userModel->getUserInIds($id);
        $manager = new UserActionProcess();
        if($manager->detele($id))
        {

            return responseJson(Lang::get('common.action_success'), true);
        }
        return responseJson($manager->getErrorMessage());
    }

    /**
     *        
     *
     * @access public
     */
    public function edit()
    {

        if(Request::method() == 'POST') return $this->updateUserInfoToDatabase();
        Session::flashInput(['http_referer' => Session::getOldInput('http_referer')]);
        $id = Request::input('id');

        $userId = url_param_decode($id);

        if( ! $userId or ! is_numeric($userId)) return Js::error(Lang::get('common.illegal_operation'), true);
        $userModel = new User(); $groupModel = new Group();
        $userInfo = $userModel->getOneUserById($userId);
        if(empty($userInfo)) return Js::error(Lang::get('user.user_not_found'), true);
        if( ! (new Acl())->checkGroupLevelPermission($userId, Acl::GROUP_LEVEL_TYPE_USER)) return Js::error(Lang::get('common.account_level_deny'), true);
        //                
        $groupInfo = $groupModel->getOneGroupById(SC::getLoginSession()->group_id);
        $isSuperSystemManager = (new Acl())->isSuperSystemManager();
        if($isSuperSystemManager) $groupInfo['level'] = 0;
        $groupList = $groupModel->getGroupLevelLessThenCurrentUser($groupInfo['level']);
        $formUrl = R('common', 'foundation.user.edit');
        return view('admin.user.add', compact('userInfo', 'formUrl', 'id', 'groupList'));
    }

    /**
     *           
     *
     * @access private
     */
    private function updateUserInfoToDatabase()
    {
        $httpReferer = Session::getOldInput('http_referer');
        $data = Request::input('data');

        if( ! $data or ! is_array($data)) return Js::error(Lang::get('common.info_incomplete'));
        $param = new \App\Services\Admin\User\Param\UserSave();
        $param->setAttributes($data);
        $manager = new UserActionProcess();
        if($manager->editUser($param))
        {

            $backUrl = ( ! empty($httpReferer)) ? $httpReferer : R('common', 'foundation.user.index');
            return Js::locate($backUrl, 'parent');
        }
        return Js::error($manager->getErrorMessage());
    }

    /**
     *        
     */
    public function mpassword()
    {
        $params = new \App\Services\Admin\User\Param\UserModifyPassword();
        $params->setOldPassword(Request::input('old_password'))->setNewPassword(Request::input('new_password'))->setNewPasswordRepeat(Request::input('new_password_repeat'));
        $manager = new UserActionProcess();
        if($manager->modifyPassword($params))
        {
            (new \App\Services\Admin\Login\Process())->getProcess()->logout();
            return responseJson(Lang::get('common.action_success'), true);
        }
        return responseJson($manager->getErrorMessage());
    }

}
