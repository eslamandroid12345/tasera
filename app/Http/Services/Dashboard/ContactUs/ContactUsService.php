<?php

namespace App\Http\Services\Dashboard\ContactUs;

use App\Repository\ContactUsRepositoryInterface;

class ContactUsService
{
    public function __construct(
        private readonly ContactUsRepositoryInterface $contactUsRepository,
    )
    {
    }

    public function index()
    {
        $contactUsMessages = $this->contactUsRepository->paginate(20, orderBy: 'desc');

        return view('dashboard.site.contact-us.index', compact('contactUsMessages'));
    }

    public function show($id)
    {
        $this->contactUsRepository->update($id, ['is_read' => true]);

        $contactUsMessage = $this->contactUsRepository->getById($id);

        return view('dashboard.site.contact-us.show', compact('contactUsMessage'));
    }

    public function destroy($id)
    {
        $this->contactUsRepository->delete($id);

        return redirect()->route('contact-us.index')->with(['success' => __('messages.deleted_successfully')]);
    }
}
