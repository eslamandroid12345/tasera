<?php

namespace App\Http\Services\Api\V1\ContactUs;

use App\Http\Requests\Api\V1\ContactUs\ContactUsRequest;
use App\Http\Traits\Responser;
use App\Repository\ContactUsRepositoryInterface;

class ContactUsService
{
    use Responser;

    public function __construct(
        private readonly ContactUsRepositoryInterface $contactUsRepository,
    )
    {
    }

    public function create(ContactUsRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth('api')?->id();

        $this->contactUsRepository->create($data);

        return $this->responseSuccess(message: __('messages.Your message has been sent successfully'));
    }

}
