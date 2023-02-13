@extends('layouts.app')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Ikatan Keluarga Alumni Pondok Pensantren Al-Ittihad <br />(IKAPPA)</h1>
            <p class="lead text-muted">Website resmi IKAPPA untuk kegiatan penggalangan dana, zakat, infaq dan sedekah.</p>

        </div>
    </section>

    <div class="container">
        <div class="container my-5">
            <div class="row ">

                @forelse ($campaigns as $campaign)
                    <x-campaign.campaign-item :campaign="$campaign" />
                @empty
                @endforelse
            </div>
        </div>
    @endsection
