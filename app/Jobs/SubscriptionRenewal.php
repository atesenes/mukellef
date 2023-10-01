<?php

namespace App\Jobs;

use App\Services\SubscriptionService;
use App\Services\TransactionService;
use App\Services\UserSubscriptionService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SubscriptionRenewal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user_subscription_service;
    private $subscription_service;
    private $transaction_service;
    /**
     * Create a new job instance.
     */
    public function __construct(UserSubscriptionService $userSubscriptionService,SubscriptionService $subscriptionService, TransactionService $transactionService)
    {
        $this->user_subscription_service = $userSubscriptionService;
        $this->subscription_service = $subscriptionService;
        $this->transaction_service = $transactionService;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $expireSubscriptions = $this->user_subscription_service->getQuery(['expired_at'=>Carbon::today()->format('d-m-Y')]);

        foreach ($expireSubscriptions as $expireSubscription)
        {
            $subscriptionDetail = $this->subscription_service->get($expireSubscription->subscription_id);
            $this->transaction_service->add(['user_id'=>$expireSubscription->user_id,'subscription_id'=>$subscriptionDetail->id,'price'=>$subscriptionDetail->price]);
            $this->user_subscription_service->findAndUpdate(['user_id'=>$expireSubscription->user_id,'subscription_id'=>$subscriptionDetail->id],
            ['renewed_at'=>Carbon::today()->format('d-m-Y'),'expired_at'=>Carbon::today()->addMonths(1)->format('d-m-Y')]);
            Log::info('Otomatik Abonelik Gerçekleşti. User: ' . $expireSubscription->user_id . ' Subscription: ' . $subscriptionDetail->id);
        }

    }
}
