<?php
/**
 * Created by PhpStorm.
 * User: zhangjinyu
 * Date: 2019/10/27
 * Time: 上午11:12
 */

namespace App\Services\User;


use App\Models\Users;
use Illuminate\Support\Facades\DB;

class UserService implements UserServiceInterface
{

    public function getList($page, $pageSize)
    {
        return Users::query()->paginate($pageSize);
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getInfo(int $id)
    {
        return Users::query()->find($id);
    }

    public  function test() {
        //return 'test';
//        DB::table('users')->
    }
}