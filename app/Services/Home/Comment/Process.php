<?php namespace App\Services\Home\Comment;

use Lang;
use App\Models\Home\Comment as CommentModel;
use App\Libraries\Js;
use App\Services\Home\BaseProcess;

/**
 *       
 *
 *  
 */
class Process extends BaseProcess
{
    /**
     *        Id，          
     */
    public function prepareReplyIds($commentList)
    {
        if( ! is_array($commentList)) return [];
        $replyIds = [];
        foreach($commentList as $key => $value)
        {
            if( ! isset($value['reply_ids']) or empty($value['reply_ids'])) continue;
            $ids = explode(',', $value['reply_ids']);
            $replyIds = array_merge($replyIds, $ids);
        }
        return array_values(array_unique($replyIds));
    }

    /**
     *            
     */
    public function joinReplyComments($commentList, $replyComments)
    {
        if( ! is_array($commentList)) return [];
        foreach($commentList as $key => $value)
        {
            $commentList[$key]['reply_content'] = $this->findReplyContents($value['reply_ids'], $replyComments);
        }
        return $commentList;
    }

    /**
     *         key       
     */
    private function findReplyContents($replyIdsString, $replyComments)
    {
        if( ! is_array($replyComments) or empty($replyIdsString)) return [];
        $replyIds = explode(',', $replyIdsString);
        $result = [];
        foreach($replyIds as $replyIdKey => $replyIdValue)
        {
            $find = [];
            foreach($replyComments as $replyCommentsKey => $replyCommentsValue)
            {
                if($replyIdValue == $replyCommentsValue['id'])
                {
                    $find = $replyCommentsValue;
                    break;
                }
            }
            $result[] = $find;
        }
        return $result;
    }

    /**
     *     
     */
    public function addComment($data)
    {
        $validate = new \App\Services\Home\Comment\Validate\Comment();
        if( ! $validate->add($data)) return $this->setErrorMsg($validate->getErrorMessage());

        $commentObject = new CommentModel();

        if( ! empty($data['replyid']))
        {
            $replyInfo = $commentObject->getOneContentById($data['replyid']);
            if(empty($replyInfo)) return $this->setErrorMsg(Lang::get('home.reply_comment_not_exist'));
            $data['reply_ids'] = ! empty($replyInfo['reply_ids']) ? $data['replyid'].','.$replyInfo['reply_ids'] : $data['replyid'];
            unset($data['replyid']);
        }

        $data['time'] = time();
        if($commentObject->addComment($data) !== false) return true;
        return $this->setErrorMsg(Lang::get('home.action_error'));
    }

}