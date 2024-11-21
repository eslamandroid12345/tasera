<?php

namespace App\Repository\Eloquent;

use App\Models\ContactUs;
use App\Repository\ContactUsRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ContactUsRepository extends Repository implements ContactUsRepositoryInterface
{
    protected Model $model;

    public function __construct(ContactUs $model)
    {
        parent::__construct($model);
    }
}
