<?php

namespace App\Http\Controllers\Dashboard\Structure;


use Illuminate\Http\Request;

class FaqController extends StructureController
{
    protected string $contentKey = 'faqs';
    protected array $locales = ['en', 'ar'];

    protected function store(Request $request){
        return parent::_store($request);
    }
}
