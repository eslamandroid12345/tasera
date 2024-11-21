<?php

namespace App\Http\Services\Dashboard\Payment;

use App\Repository\PaymentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class PaymentService
{
    public function __construct(private PaymentRepositoryInterface $repository)
    {

    }

    public function index()
    {
        $payments = $this->repository->paginate(20,relations: ['company'],orderBy: 'DESC');
        return view('dashboard.site.payments.index', compact('payments'));
    }

    public function show($id)
    {
        $payment = $this->repository->getById($id,relations: ['company']);
        return view('dashboard.site.payments.show', compact('payment'));
    }
    public function update($request, $id)
    {
        try {
            $data = $request->validated();
            update_model($this->repository, $id, ['status'=>$data['status']]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
