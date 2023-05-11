<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Alert;
use App\Models\Generation;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::active()->paginate(8);
        return view('campaign.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        // data kegiatan beserta donasi yang sudah berhasil dibayar
        $campaign = $campaign->with(['donasis' => function ($q) {
            $q->alredyPaid();
        }])->where('slug', $campaign->slug)->first();

        // data seluruh angkatan
        $generations = Generation::all();

        // data seluruh angkatan diurutkan berdasarkan donasi terbanyak
        $donasiGenerations = Generation::with('donasis')->whereRelation('donasis', 'campaign_id', $campaign->id)->get();

        // urutkan berdasarkan donasi terbanyak
        $donasiGenerations = $donasiGenerations->sortByDesc(function ($generation) {
            return $generation->donasis->sum('paid');
        });

        return view('campaign.show', compact('campaign', 'generations', 'donasiGenerations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        //
    }
}
