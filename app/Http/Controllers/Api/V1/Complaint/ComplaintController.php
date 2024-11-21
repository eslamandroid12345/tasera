<?php

namespace App\Http\Controllers\Api\V1\Complaint;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Complaint\ComplaintRequest;
use App\Http\Services\Api\V1\Complaint\ComplaintService;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function __construct(
        private readonly ComplaintService $complaint,
    )
    {
    }

    public function create(ComplaintRequest $request)
    {
        return $this->complaint->create($request);
    }
}
