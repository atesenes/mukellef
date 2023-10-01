<?php

namespace App\Jobs;

use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SubscriptionRenewal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::notice('Subscription Renewal is Run');
        $expireSubscriptions = UserSubscription::where(['expired_at'=>Carbon::today()->format('Y-m-d')])->get();

        foreach ($expireSubscriptions as $expireSubscription)
        {
            $subscriptionDetail = Subscription::find($expireSubscription->subscription_id);
            Transaction::create(['user_id'=>$expireSubscription->user_id,'subscription_id'=>$subscriptionDetail->id,'price'=>$subscriptionDetail->price]);
            UserSubscription::find($expireSubscription->id)->update(['renewed_at'=>Carbon::today()->format('Y-m-d'),'expired_at'=>Carbon::today()->addMonths(1)->format('Y-m-d')]);
            Log::info('Otomatik Abonelik Gerçekleşti. User: ' . $expireSubscription->user_id . ' Subscription: ' . $subscriptionDetail->id);
        }

    }
}
