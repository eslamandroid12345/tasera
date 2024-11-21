<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository implements UserRepositoryInterface
{
    protected Model $model;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function updatePasswordByEmail($email, $password)
    {
        $user = $this->first('email', $email);

        return $user->update(['password' => $password]);
    }

    public function getLatestUserLogin($company_id)
    {
        return $this->model::query()->where('company_id', $company_id)->latest()->first();
    }

    public function getCommonSuppliers($purchase_order)
    {
        return $this->model::whereHas('company', function ($query) use ($purchase_order) {
            $query->where('type', 'supplier');
            $query->whereHas('fields', function ($fieldQuery) use ($purchase_order) {
                $fieldQuery->whereIn('fields.id', $purchase_order->fields->pluck('id'));
            });
        })->get();
    }

    public function getAllUserBuyerReport()
    {
        return $this->model::withWhereHas('company', function ($query) {
                $query->where('type', 'buyer');
                $query->withWhereHas('purchaseOrders',function($query){
                    $query->where('status', 'available');
                    $query->withCount('publishedOffers');
                    $query->withCount('publishedNotRepliedInquires');
                });
            })->get();
    }
}
