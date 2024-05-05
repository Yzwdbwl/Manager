<?php namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * 文章表模型
 *
 * @author jiang
 */
class Content extends Model
{
    /**
     * 文章未删除的标识
     */
    CONST IS_DELETE_NO = 1;

    /**
     * 文章发布的标识
     */
    CONST STATUS_YES = 1;

    /**
     * 文章数据表名
     *
     * @var string
     */
    protected $table = 'artice';

    /**
     * 表前缀
     *
     * @var string
     */
    private $prefix;

    /**
     * 取得文章列表信息
     *
     * @return array
     */
    public function activeArticleInfo($object)
    {

        if($object->tag){
            $currentQuery = $this->where('name', 'like', "%{$object->tag}%")->orderBy('id', 'desc');
        }else{
            $currentQuery = $this->orderBy('id', 'desc');
        }


        $total = $currentQuery->get()->count();
        $currentQuery->forPage(
            $page = Paginator::resolveCurrentPage(),
            $perPage = 20
        );

        $data = $currentQuery->get()->all();

        return new LengthAwarePaginator($data, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath()
        ]);
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
        $this->prefix = \DB:: getTablePrefix();
        $currentQuery = $this ->where('id', $articleId)->first();
        $info = $currentQuery->toArray();
        return $info;
    }



}
