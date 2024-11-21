<?php

namespace App\Http\Services\Dashboard\Payment\Subscription;

use App\Repository\SubscriptionRepositoryInterface;
use function App\update_model;

class SubscriptionService
{
    public function __construct(private SubscriptionRepositoryInterface $repository)
    {

    }

    public function index()
    {
        $subscriptions = $this->repository->paginate(20,relations: ['company','package','payment'],orderBy: 'DESC');
        return view('dashboard.site.subscriptions.index', compact('subscriptions'));
    }
    public function edit($id)
    {
        $subscription = $this->repository->getById($id);
        return view('dashboard.site.subscriptions.edit', compact('subscription'));
    }

    public function update($request, $id)
    {
        try {
            $data = $request->validated();
            update_model($this->repository, $id, ['ends_at'=>$data['ends_at']]);
            return redirect()->route('subscriptions.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
    public function toggle()
    {
        try {
            update_model($this->repository, request('itemId'), ['is_active' => request('status')]);
            return true;
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
}
