<?php namespace App\Models\Admin;



/**
 * 文章表模型
 *
 * @author jiang
 */
class Content extends Base
{
    /**
     * 文章数据表名
     *
     * @var string
     */
    protected $table = 'artice';

    /**
     * 可以被集体附值的表的字段
     *
     * @var string
     */
    protected $fillable = array('id', 'name', 'subtitle', 'other', 'create_at', 'content', 'is_delete', 'status');

    /**
     * 文章未删除的标识
     */
    CONST IS_DELETE_NO = 1;

    /**
     * 文章删除的标识
     */
    CONST IS_DELETE_YES = 0;

    /**
     * 取得未删除的信息
     *
     * @return array
     * @todo 数据量多时，查找属于指定分类，推荐位，标签三个的文章时使用redis集合交集处理，避免查询消耗。
     */
    public function AllContents($search = [])
    {

        $currentQuery = $this->where('name', 'like', "%{$search['keyword']}%")->orderBy('id', 'desc')->paginate(self::PAGE_NUMS);
        return $currentQuery;

    }


    /**
     * 增加文章
     *
     * @param array $data 所需要插入的信息
     */
    public function addContent(array $data)
    {
        return $this->create($data);
    }

    /**
     * 修改文章
     *
     * @param array $data 所需要插入的信息
     */
    public function editContent(array $data, $id)
    {
        return $this->where('id', '=', intval($id))->update($data);
    }
    /**
     * 取得一篇文章主表和副表的信息
     *
     * @param int $articleId 文章的ID
     * @return array
     */
    public function getContentDetailByArticleId($articleId)
    {
        $articleId = (int) $articleId;
        $currentQuery = $this ->where('id', $articleId)->first();
        $info = $currentQuery->toArray();
        return $info;
    }
    /**
     * 取得指定ID信息
     *
     * @param intval $id 文章的ID
     * @return array
     */
    public function getOneById($id)
    {
        return $this->where('id', '=', intval($id))->first();
    }

    /**
     * 批量软删除
     */
    public function solfDeleteContent(array $data, array $ids)
    {
        return $this->whereIn('id', $ids)->update($data);
    }


}
