<?php namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use App\Models\Home\SearchDict as SearchDictModel;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

/** *
 *
 */
class Search extends Model
{
    /**
     * 文章未Delete的标识
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
     * dict model object
     *
     * @var object
     */
    private $dictModelObject;

    /**
     * 临时保存，避免多次查询
     *
     * @var [type]
     */
    private $dictDataCache;

    /**
     *
     * @return array
     */
    public function activeArticleInfoBySearch($object)
    {

        //\DB::connection()->enableQueryLog();
        if( ! isset($object)) return [];

        $currentQuery = $this->where('name', 'like', "%{$object}%")->orderBy('id', 'desc');
        $total = $currentQuery->get()->count();
        $currentQuery->forPage(
            $page = Paginator::resolveCurrentPage(),
            $perPage = 20
        );

        $data = $currentQuery->get()->all();
        //$queries = \DB::getQueryLog();
        //dd($total, $queries);

        return new LengthAwarePaginator($data, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath()
        ]);
    }



}
