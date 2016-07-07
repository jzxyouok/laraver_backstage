<?php

namespace App\Models;


class WXList extends CommonModel
{
    protected $table="wxlist";
    protected $fillable = ['name','url','status'];
}
