<?php

namespace App\Http\Controllers\Dashboard\Structure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends StructureController
{
    protected string $contentKey = 'about';
    protected array $locales = ['en', 'ar'];

    protected function store(Request $request){
        return parent::_store($request);
    }
}
