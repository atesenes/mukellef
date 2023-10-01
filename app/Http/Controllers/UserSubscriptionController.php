<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Requests\UserSubscriptionRequest;
use App\Services\SubscriptionService;
use App\Services\TransactionService;
use App\Services\UserService;
use App\Services\UserSubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserSubscriptionController extends Controller
{
    protected $user_service;
    protected $user_subscription_service;
    protected $transaction_service;

    public function __construct(UserService $userService,UserSubscriptionService $userSubscriptionService,TransactionService $transactionService)
    {
        $this->user_service = $userService;
        $this->user_subscription_service = $userSubscriptionService;
        $this->transaction_service = $transactionService;
    }

    public function store($user_id,$subscription_id,UserSubscriptionRequest $userSubscriptionRequest)
    {
        if ($userSubscriptionRequest->getErrorMessage() != [])
        {
            return response()->json(['message' => $userSubscriptionRequest->getErrorMessage()], 422);
        }
        try {
            $subscription = $this->user_subscription_service->add(['user_id'=>$user_id,'subscription_id'=>$subscription_id],$userSubscriptionRequest->only('expired_at','renewed_at'));
            if (isset($subscription))
                return response()->json(['message'=>'Başarılı olarak abone oldunuz'],201);
            else
                return response()->json(['message'=>'İşlem kaydedilemedi'],404);

        }catch (\Exception $e)
        {
            return response()->json(['message'=>'Bir sorun oluştu'],404);
        }
    }
    public function update($user_id,$subscription_id,UserSubscriptionRequest $userSubscriptionRequest)
    {

        if ($userSubscriptionRequest->getErrorMessage() != [])
        {
            return response()->json(['message' => $userSubscriptionRequest->getErrorMessage()], 422);
        }

        try {
            $subscription = $this->user_subscription_service->findAndUpdate(['user_id'=>$user_id,'subscription_id'=>$subscription_id],
                $userSubscriptionRequest->only('expired_at','renewed_at'));
            if (isset($subscription))
                return response()->json(['message'=>'Üyelik tarihini yenilediniz'],201);
            else
                return response()->json(['message'=>'İşlem kaydedilemedi'],404);

        }catch (\Exception $e)
        {
            return response()->json(['message'=>'Bir sorun oluştu'],404);
        }
    }
    public function destroy($user_id,$subscription_id)
    {

        try {
            $record = $this->user_subscription_service->firstQuery(['subscription_id'=>$subscription_id,'user_id'=>$user_id]);
            if (isset($record))
            {
                $deleteRecord = $this->user_subscription_service->delete($record->id);
                if ($deleteRecord)
                    return response()->json(['message'=>'Üyelik silindi'],201);
                else
                    return response()->json(['message'=>'İşlem kaydedilemedi'],404);
            }
            else
                return response()->json(['message'=>'Önceden Silinen Kayıt'],201);

        }catch (\Exception $e)
        {
            return response()->json(['message'=>'Bir sorun oluştu'],404);
        }
    }
    public function transaction(TransactionRequest $transactionRequest,$user_id)
    {
        if ($transactionRequest->getErrorMessage() != [])
            return response()->json(['message' => $transactionRequest->getErrorMessage()], 422);
        $newTransaction = $transactionRequest->all();
        $newTransaction['user_id'] = $user_id;

        $record = $this->transaction_service->add($newTransaction);
        if ($record)
            return response()->json(['message'=>'İşlem kaydedildi'],201);
        else
            return response()->json(['message'=>'İşlem kaydedilemedi'],404);

    }
}
