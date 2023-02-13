@extends('layouts.app')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Penggalangan Dana</h1>
        </div>
    </section>

    <div class="container">
        <div class="container my-5">
            <div class="row">
                @forelse ($campaigns as $campaign)
                    <x-campaign.campaign-item :campaign="$campaign" />
                @empty
                @endforelse
            </div>

            <div class="d-flex justify-content-center">
                {!! $campaigns->links() !!}
            </div>
        </div>
    @endsection
