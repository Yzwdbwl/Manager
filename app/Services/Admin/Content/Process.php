<?php namespace App\Services\Admin\Content;

use Lang;
use App\Models\Admin\Content as ContentModel;
use App\Models\Admin\TagsRelation as TagsRelationModel;
use App\Models\Admin\Tags as TagsModel;
use App\Models\Admin\ClassifyRelation as ClassifyRelationModel;
use App\Models\Admin\ContentDetail as ContentDetailModel;
use App\Models\Admin\PositionRelation as PositionRelationModel;
use App\Models\Admin\SearchIndex as SearchIndexModel;
use App\Services\Admin\Content\Validate\Content as ContentValidate;
use App\Services\Admin\SC;
use App\Libraries\Spliter;
use App\Services\Admin\BaseProcess;

/**
 * 文章处理
 *
 *  
 */
class Process extends BaseProcess
{
    /**
     * 文章模型
     *
     * @var object
     */
    private $contentModel;

    /**
     * 文章副表模型
     *
     * @var object
     */
    private $contentDetailModel;

    /**
     * 文章表单验证对象
     *
     * @var object
     */
    private $contentValidate;

    /**
     * 初始化
     *
     * @access public
     */
    public function __construct()
    {
        if( ! $this->contentModel) $this->contentModel = new ContentModel();
        if( ! $this->contentValidate) $this->contentValidate = new ContentValidate();
    }

    /**
     * 增加新的文章
     *
     * @param string $data
     * @access public
     * @return boolean true|false
     */
    public function addContent(\App\Services\Admin\Content\Param\ContentSave $data)
    {
        if( ! $this->contentValidate->add($data))
        {
            $unValidateMsg = $this->contentValidate->getErrorMessage();
            return $this->setErrorMsg($unValidateMsg);
        }

        $object = new \stdClass();
        $object->time = time();
        $object->userId = SC::getLoginSession()->id;

        try
        {
            $result = \DB::transaction(function() use ($data, $object)
            {
                $object->contentAutoId = $this->saveContent($data, $object);

                return true;
            });
        }
        catch (\Exception $e)
        {
            $result = false;
        }

        if( ! $result) return $this->setErrorMsg(Lang::get('common.action_error'));

        return true;
    }

    /**
     * 编辑文章，因为使用了事务，如果没有成功请手动抛出异常
     *
     * @param string $data
     * @access public
     * @return boolean true|false
     */
    public function editContent(\App\Services\Admin\Content\Param\ContentSave $data, $id)
    {
        if( ! $this->contentValidate->edit($data))
        {

            $unValidateMsg = $this->contentValidate->getErrorMessage();
            return $this->setErrorMsg($unValidateMsg);
        }

        $object = new \stdClass();
        $object->contentAutoId = $id;
//
//        try
//        {
            $result = \DB::transaction(function() use ($data, $id, $object)
            {
                $this->updateContent($data, $id);


                return true;
            });
//        }
//        catch (\Exception $e)
//        {
//            $result = false;
//        }

        if( ! $result)
        {
            return $this->setErrorMsg(Lang::get('common.action_error'));
        }
        return true;
    }
    /**
     * 保存到主表，因为使用了事务，如果没有成功请手动抛出异常
     *
     * @param  array $data
     * @return int 自增的ID
     */
    private function saveContent(\App\Services\Admin\Content\Param\ContentSave $data, $object)
    {
        $dataContet['is_delete'] = ContentModel::IS_DELETE_NO;

        $dataContet['other'] = $data['other'];
        $dataContet['name'] = $data['name'];
        $dataContet['status'] = 1;
        $dataContet['content'] = $data['content'];
        $dataContet['subtitle'] = $data['subtitle'];
        $insertObject = $this->contentModel->addContent($dataContet);
        if( ! $insertObject->id)
        {
            throw new \Exception("save content error");
        }
        return $insertObject->id;
    }
    /**
     * Delete文章，因为使用了事务，如果没有成功请手动抛出异常
     *
     * @param array $ids 要Delete的文章的id
     * @access public
     * @return boolean true|false
     */
    public function detele($ids)
    {
        if( ! is_array($ids)) return false;
        $data['is_delete'] = ContentModel::IS_DELETE_YES;
        try
        {
            $result = \DB::transaction(function() use ($data, $ids)
            {
                $this->contentModel->solfDeleteContent($data, $ids);

                return true;
            });
        }
        catch (\Exception $e)
        {
            $result = false;
        }

        if( ! $result) return $this->setErrorMsg(Lang::get('common.action_error'));

        return $result;
    }











    /**
     * 保存到主表，因为使用了事务，如果没有成功请手动抛出异常
     *
     * @param  array $data
     * @return int 自增的ID
     */
    private function updateContent(\App\Services\Admin\Content\Param\ContentSave $data, $id)
    {
        $dataContet['name'] = $data['name'];
        $dataContet['status'] = $data['status'];
        $dataContet['subtitle'] = $data['subtitle'];
        $dataContet['content'] = $data['content'];
        $dataContet['other'] = $data['other'];
        $result = $this->contentModel->editContent($dataContet, $id);
        if($result === false)
        {
            throw new \Exception("save content error");
        }
        return $result;
    }




}
