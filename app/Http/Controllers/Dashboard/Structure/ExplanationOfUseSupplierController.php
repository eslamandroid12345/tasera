<?php

namespace App\Http\Controllers\Dashboard\Structure;


use Illuminate\Http\Request;

class ExplanationOfUseSupplierController extends StructureController
{
    protected string $contentKey = 'explanation-of-use-supplier';
    protected array $locales = ['en', 'ar'];

    protected function store(Request $request){
        return parent::_store($request);
    }
}
