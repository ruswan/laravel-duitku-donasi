@props(['campaign'])

<div class="col-md-4">
    <div class="card">
        <a href="{{ route('campaign.show', [$campaign->slug]) }}"><img class="card-img-top"
                src="{{ Storage::url('public/campaigns/default.png') }}" alt="{{ $campaign->name }}"></a>
        <div class="card-body">
            <h5 class="card-title"> <a
                    href="{{ route('campaign.show', [$campaign->slug]) }}">{{ Str::words($campaign->name, 6) }}</a>
            </h5>
            <p class="card-text">{{ Str::words($campaign->description, 15) }}</p>
            <a href="{{ route('campaign.show', [$campaign->slug]) }}" class="btn btn-primary">Ikut
                Donasi</a>
        </div>
    </div>
</div>
