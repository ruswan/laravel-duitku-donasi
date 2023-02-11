<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    protected function onPaymentSuccess(string $orderId, string $productDetail, int $amount, string $paymentCode, ?string $shopeeUserHash, string $reference, ?string $additionalParam): void
    {
        $invoice = Donasi::where('code', $orderId)->first();
        if (!$invoice) return;
        $invoice->paid = $amount;
        $invoice->save();
    }

    protected function onPaymentFailed(string $orderId, string $productDetail, int $amount, string $paymentCode, ?string $shopeeUserHash, string $reference, ?string $additionalParam): void
    {
        $invoice = Donasi::where('code', $orderId)->first();
        if (!$invoice) return;
        /*
         * Transaction failed, just delete
         */
        $invoice->delete();
    }

    public function myReturnCallback()
    {
        return 'You can close this page';
    }
}
