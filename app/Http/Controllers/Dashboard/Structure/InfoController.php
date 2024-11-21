<?php

namespace App\Http\Controllers\Dashboard\Structure;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Structure\InfoRequest;
use Illuminate\Http\Request;

class InfoController  extends StructureController
{
    protected string $contentKey = 'infos';
    protected array $locales = ['en', 'ar'];

    protected function store(InfoRequest $request){
//        return $request;
        return parent::_store($request);
    }
}
