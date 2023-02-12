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
                    <div class="col-md-4">
                        <div class="card">
                            <a href="{{ route('campaign.show', [$campaign->slug]) }}"><img class="card-img-top"
                                    src="{{ Storage::url('public/campaigns/default.png') }}"
                                    alt="{{ $campaign->name }}"></a>
                            <div class="card-body">
                                <h5 class="card-title"> <a
                                        href="{{ route('campaign.show', [$campaign->slug]) }}">{{ Str::words($campaign->name, 6) }}</a>
                                </h5>
                                <p class="card-text">{{ Str::words($campaign->description, 15) }}</p>
                                <a href="{{ route('campaign.show', [$campaign->slug]) }}" class="btn btn-primary">Iku
                                    Donasi</a>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    @endsection
