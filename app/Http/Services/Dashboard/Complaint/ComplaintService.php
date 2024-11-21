<?php

namespace App\Http\Services\Dashboard\Complaint;

use App\Repository\ComplaintRepositoryInterface;

class ComplaintService
{
    public function __construct(
        private readonly ComplaintRepositoryInterface $complaintRepository,
    )
    {
    }

    public function index()
    {
        $complaints = $this->complaintRepository->paginate(20, orderBy: 'desc');

        return view('dashboard.site.complaints.index', compact('complaints'));
    }

    public function show($id)
    {
        $this->complaintRepository->update($id, ['is_read' => true]);

        $complaint = $this->complaintRepository->getById($id);

        return view('dashboard.site.complaints.show', compact('complaint'));
    }

    public function destroy($id)
    {
        $this->complaintRepository->delete($id);

        return redirect()->route('complaints.index')->with(['success' => __('messages.deleted_successfully')]);
    }

}
