<?php

namespace App\Http\Controllers\Dashboard\Structure;


use Illuminate\Http\Request;

class TermsAndConditionsController extends StructureController
{
    protected string $contentKey = 'terms-and-conditions';
    protected array $locales = ['en', 'ar'];

    protected function store(Request $request){
        return parent::_store($request);
    }
}
