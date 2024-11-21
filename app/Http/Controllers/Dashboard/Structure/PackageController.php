<?php

namespace App\Http\Controllers\Dashboard\Structure;


use Illuminate\Http\Request;

class PackageController extends StructureController
{
    protected string $contentKey = 'packages';
    protected array $locales = ['en', 'ar'];

    protected function store(Request $request){
        return parent::_store($request);
    }
}
