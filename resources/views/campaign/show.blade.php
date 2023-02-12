@extends('layouts.app')

@section('content')
    <div class="container">

        <section class=" text-center">
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <img class="card-img-top" src="{{ Storage::url('public/campaigns/default.png') }}"
                                alt="{{ $campaign->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ Str::words($campaign->name, 6) }}</h5>
                                <p class="card-text">{{ Str::words($campaign->description, 15) }}</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                {{ $campaign->name }}
                            </div>
                            <div class="card-body">
                                <form method="POST">
                                    @csrf
                                    <div class="mb-2">
                                        <label>Jumlah</label>
                                        <input required id="amount" min="10000" type="number" class="form-control"
                                            autofocus>
                                    </div>

                                    <div class="mb-2">
                                        <label>Nama Lengkap</label>
                                        <input required id="name" value="" type="text" class="form-control"
                                            placeholder="Nama Lengkap">
                                    </div>

                                    <div class="mb-2">
                                        <label>Email</label>
                                        <input required id="email" value="" type="text" class="form-control"
                                            placeholder="Email aktif untuk pemberitahuan">
                                    </div>

                                    <div class="mb-2">
                                        <label>Nomor Handphone/WA</label>
                                        <input required id="phoneNumber" type="number" class="form-control">
                                    </div>

                                    <button type="button" id="submit" class="btn btn-primary w-100 my-2 shadow"
                                        onClick="payment();">Bayar</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Request to backend with ajax -->
        <script type="text/javascript">
            function payment() {
                var amount = document.getElementById("amount").value;
                var email = document.getElementById("email").value;
                var name = document.getElementById("name").value;
                var phoneNumber = document.getElementById("phoneNumber").value;
                var paymentUi = "1";
                $.ajax({
                    type: "POST",
                    data: {
                        amount: amount,
                        name: name,
                        email: email,
                        phoneNumber: phoneNumber,
                        _token: "{{ csrf_token() }}",
                    },
                    url: '{{ route('donasis.store', [$campaign->slug]) }}',
                    dataType: "json",
                    cache: false,
                    success: function(result) {
                        console.log(result.reference);
                        console.log(result);

                        if (paymentUi === "2") { // user redirect payment interface
                            window.location = result.paymentUrl;
                        }

                        checkout.process(result.reference, {
                            successEvent: function(result) {
                                // begin your code here
                                console.log('success');
                                console.log(result);
                                alert('Payment Success');
                            },
                            pendingEvent: function(result) {
                                // begin your code here
                                console.log('pending');
                                console.log(result);
                                alert('Payment Pending');
                            },
                            errorEvent: function(result) {
                                // begin your code here
                                console.log('error');
                                console.log(result);
                                alert('Payment Error');
                            },
                            closeEvent: function(result) {
                                // begin your code here
                                console.log(
                                    'customer closed the popup without finishing the payment');
                                console.log(result);
                                alert('customer closed the popup without finishing the payment');
                            }
                        });

                    },
                });

            }
        </script>
    @endsection