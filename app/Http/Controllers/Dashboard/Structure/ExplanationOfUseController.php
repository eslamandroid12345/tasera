<?php

namespace App\Http\Controllers\Dashboard\Structure;


use Illuminate\Http\Request;

class ExplanationOfUseController extends StructureController
{
    protected string $contentKey = 'explanation-of-use';
    protected array $locales = ['en', 'ar'];

    protected function store(Request $request){
        return parent::_store($request);
    }
}
