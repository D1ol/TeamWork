<?php
/**
 * Created by PhpStorm.
 * User: Ihor
 * Date: 31.07.2019
 * Time: 13:59
 */

namespace App\Core;


interface Transaction
{
    public function begin();
    public function commit();
    public function rollback();
}