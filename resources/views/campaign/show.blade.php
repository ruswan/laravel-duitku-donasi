@extends('layouts.app')

@section('content')
    <div class="container">

        <section>
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card mb-2">
                            <img class="card-img-top" src="{{ Storage::url('public/campaigns/default.png') }}"
                                alt="{{ $campaign->name }}">
                            <div class="card-body">
                                <h3 class="card-title">{{ $campaign->name }}</h3>
                                <h5>Terhimpun @currency($campaign->donasis->sum('paid'))</h5>
                                <div class="mt-3 d-sm-block d-md-none">
                                    <a href="#donation" class="btn btn-primary w-100 my-2 shadow">Donasi
                                        Sekarang</a>
                                </div>
                                <hr />
                                <p class="card-text">{{ $campaign->description }}</p>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="card-body">
                                <h4 class="card-title">Para Donatur</h4>
                                <ul class="list-group">
                                    @forelse ($campaign->donasis as $donatur)
                                        <li class="list-group-item"><b>{{ $donatur->user_name }}</b>
                                            {{ \Carbon\Carbon::parse($donatur->updated_at)->diffForHumans() }} berdonasi
                                            sebesar
                                            @currency($donatur->paid)

                                        </li>
                                    @empty
                                        <li class="list-group-item">Belum ada donatur</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4" id="donation">
                        <div class="card">
                            <div class="card-header">
                                Formulir Pengisian Donasi
                            </div>
                            <div class="card-body">
                                <form method="POST">
                                    @csrf
                                    <div class="mb-2 form-group">
                                        <label for="amount">Nominal Donasi</label>
                                        <input required id="amount" min="10000" type="number" class="form-control"
                                            autofocus>
                                    </div>

                                    <div class="mb-2 form-group">
                                        <label>Nama Lengkap</label>
                                        <input required id="name" value="" type="text" class="form-control">
                                    </div>

                                    <div class="mb-2 form-group">
                                        <label>Email (Email aktif untuk pemberitahuan)</label>
                                        <input required id="email" value="" type="text" class="form-control">
                                    </div>

                                    <div class="mb-2 form-group">
                                        <label>Nomor Handphone/WA</label>
                                        <input required id="phoneNumber" value="" type="number" class="form-control">
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
                var amount = $('#amount').val();
                var name = $('#name').val();
                var email = $('#email').val();
                var phoneNumber = $('#phoneNumber').val();
                var paymentUi = "1";

                if (amount < 10000) {
                    alert("Minimal 10 ribu");
                    $('#amount').focus();
                    return false;
                }

                if (name.length === 0) {
                    alert("Kolom Nama Lengkap wajib diisi");
                    $('#name').focus();
                    return false;
                }

                if (email.length === 0) {
                    alert("Kolom Email wajib diisi");
                    $('#email').focus();
                    return false;
                }

                if ((phoneNumber.length < 10) || phoneNumber.length > 13) {
                    alert("Nomor handphone minimal 10 digit maksimal 13 digit");
                    $('#phoneNumber').focus();
                    return false;
                }

                // Disable button
                $("#submit").html("Memproses..");
                $("#submit").prop('disabled', true);

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
                                location.reload();
                            },
                            pendingEvent: function(result) {
                                // begin your code here
                                console.log('pending');
                                console.log(result);
                                alert('Payment Pending');
                                location.reload();
                            },
                            errorEvent: function(result) {
                                // begin your code here
                                console.log('error');
                                console.log(result);
                                alert('Payment Error');
                                location.reload();
                            },
                            closeEvent: function(result) {
                                // begin your code here
                                console.log(
                                    'customer closed the popup without finishing the payment');
                                console.log(result);
                                alert('customer closed the popup without finishing the payment');
                                location.reload();
                            }
                        });

                    },
                });

            }
        </script>
    @endsection
