<?php

namespace App\Http\Controllers\Dashboard\Structure;


use Illuminate\Http\Request;

class ExplanationOfUseBuyerController extends StructureController
{
    protected string $contentKey = 'explanation-of-use-buyer';
    protected array $locales = ['en', 'ar'];

    protected function store(Request $request){
        return parent::_store($request);
    }
}
