<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonasiRequest;
use App\Models\Campaign;
use App\Models\Donasi;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonasiRequest $request, $slug)
    {
        $campaign = Campaign::where('slug', $slug)->first();

        $duitkuConfig       = new \Duitku\Config(config('services.duitku.api_key'), config('services.duitku.merchan_code'));
        $duitkuConfig->setDuitkuLogs(false);
        $paymentAmount      = $request->amount;
        $email              = $request->email;
        $phoneNumber        = $request->phoneNumber;
        $productDetails     = $campaign->name;
        $merchantOrderId    = time();
        $additionalParam    = '';
        $merchantUserInfo   = '';
        $customerVaName     = $request->name;
        $callbackUrl        = config('services.duitku.calback_url');
        $returnUrl          = config('services.duitku.return_url');
        $expiryPeriod       = 60;

        // Customer Detail
        $name = explode(' ', $customerVaName);
        $firstName = $name[0];
        $lastName = $name[1] ?? $name[0];

        // Address
        $alamat = 'Jl. Raya Bandung, KM. 3';
        $city = 'Cianjur';
        $postalCode = '43281';
        $countryCode = 'ID';

        $address = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'address' => $alamat,
            'city' => $city,
            'postalCode' => $postalCode,
            'phoneNumber' => $phoneNumber,
            'countryCode' => $countryCode,
        ];

        $customerDetail = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'billingAddress' => $address,
            'shippingAddress' => $address,
        ];

        // Item Details
        $item1 = [
            'name' => $productDetails,
            'price' => $paymentAmount,
            'quantity' => 1,
        ];

        $itemDetails = [$item1];

        $params = [
            'paymentAmount' => $paymentAmount,
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => $productDetails,
            'additionalParam' => $additionalParam,
            'merchantUserInfo' => $merchantUserInfo,
            'customerVaName' => $customerVaName,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'itemDetails' => $itemDetails,
            'customerDetail' => $customerDetail,
            'callbackUrl' => $callbackUrl,
            'returnUrl' => $returnUrl,
            'expiryPeriod' => $expiryPeriod,
        ];

        try {
            // createdonasi Request
            $responseDuitkuPop = \Duitku\Pop::createInvoice($params, $duitkuConfig);

            // decode response
            $response = json_decode($responseDuitkuPop);

            // insert into table
            $campaign->donasis()->create([
                'code'  => 'ALTIE' . time(),
                'user_name' => $customerVaName,
                'user_email' => $email,
                'user_phone'    => $phoneNumber,
                'generation_id' => $request->generationId,
                'amount'    => $paymentAmount,
                'duitku_ref' => $response->reference,
                'payment_url' => $response->paymentUrl,
            ]);

            header('Content-Type: application/json');
            echo $responseDuitkuPop;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function show(Donasi $donasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Donasi $donasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donasi $donasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donasi $donasi)
    {
        //
    }
}
