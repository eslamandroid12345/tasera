<?php

namespace App\Repository\Eloquent;

use App\Models\Complaint;
use App\Repository\ComplaintRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ComplaintRepository extends Repository implements ComplaintRepositoryInterface
{
    protected Model $model;

    public function __construct(Complaint $model)
    {
        parent::__construct($model);
    }
}
