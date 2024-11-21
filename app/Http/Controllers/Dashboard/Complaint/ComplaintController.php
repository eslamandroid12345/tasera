<?php

namespace App\Http\Controllers\Dashboard\Complaint;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\Complaint\ComplaintService;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function __construct(
        private readonly ComplaintService $complaint,
    )
    {
    }

    public function index()
    {
        return $this->complaint->index();
    }

    public function show($id)
    {
        return $this->complaint->show($id);
    }

    public function destroy($id)
    {
        return $this->complaint->destroy($id);
    }
}
