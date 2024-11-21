<?php

namespace App\Http\Controllers\Dashboard\Structure;


use Illuminate\Http\Request;

class HomeController extends StructureController
{
    protected string $contentKey = 'home';
    protected array $locales = ['en', 'ar'];

    protected function store(Request $request){
        return parent::_store($request);
    }
}
