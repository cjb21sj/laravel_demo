<?php
/**
 * Created by PhpStorm.
 * User: zhangjinyu
 * Date: 2019/10/27
 * Time: 上午11:11
 */

namespace App\Services\User;


interface UserServiceInterface
{

    public function getList($page, $pageSize);

    public function getInfo(int $id);
}