<?php

namespace App\Http\Services\Api\V1\Complaint;

use App\Http\Requests\Api\V1\Complaint\ComplaintRequest;
use App\Http\Traits\Responser;
use App\Repository\ComplaintRepositoryInterface;

class ComplaintService
{
    use Responser;

    public function __construct(
        private readonly ComplaintRepositoryInterface $complaintRepository,
    )
    {
    }

    public function create(ComplaintRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth('api')?->id();

        $this->complaintRepository->create($data);

        return $this->responseSuccess(message: __('messages.Your complaint has been sent successfully'));
    }

}
