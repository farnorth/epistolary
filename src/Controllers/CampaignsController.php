<?php

namespace Pilaster\Newsletters\Controllers;

use Illuminate\Http\Request;
use Pilaster\Newsletters\Campaign;

class CampaignsController extends Controller
{
    /**
     * Display a listing of newsletters.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $campaigns = Campaign::all();

        return view('newsletters::campaigns.index', compact('campaigns'));
    }

    /**
     * Show a single newsletter.
     *
     * @param int|string $campaign_id
     * @return \Illuminate\View\View
     */
    public function show($campaign_id)
    {
        $campaign = $this->getCampaign($campaign_id);

        return view('newsletters::campaigns.show', compact('campaign'));
    }

    /**
     * Show the form to edit a newsletter.
     *
     * @param int|string $campaign_id
     * @return \Illuminate\View\View
     */
    public function edit($campaign_id)
    {
        $campaign = $this->getCampaign($campaign_id);

        return view('newsletters::campaigns.edit', compact('campaign'));
    }

    /**
     * Update a newsletter.
     *
     * @param \Illuminate\Http\Request $request
     * @param int|string $campaign_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $campaign_id)
    {
        $campaign = $this->getCampaign($campaign_id);
        $campaign->update($this->newsletterAttributesFrom($request));

        session()->flash('success', sprintf('Updated campaign %s', $campaign->name));

        return redirect()->route('newsletters::campaigns.index');
    }

    /**
     * Show the form to create a new newsletter.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('newsletters::campaigns.create');
    }

    /**
     * Save a newly created newsletter to the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $campaign = new Campaign($this->newsletterAttributesFrom($request));
        $campaign->save();

        session()->flash('success', sprintf('Created campaign %s', $campaign->name));

        return redirect()->route('newsletters::campaigns.index');
    }

    /**
     * Delete a newsletter.
     *
     * @param int|string $campaign_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($campaign_id)
    {
        $campaign = $this->getCampaign($campaign_id);
        $campaign->delete();

        session()->flash('success', sprintf('Deleted campaign %s', $campaign->name));

        return redirect()->route('newsletters::campaigns.index');
    }

    /**
     * Get a newsletter by its ID or slug.
     *
     * @param int|string $campaign
     * @return \Pilaster\Newsletters\Campaign
     */
    private function getCampaign($campaign)
    {
        if (is_numeric($campaign)) {
            return Campaign::find($campaign);
        }

        return Campaign::getBySlug($campaign);
    }

    /**
     * Build the array of attributes for a newsletter from a request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private function newsletterAttributesFrom(Request $request)
    {
        return [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ];
    }
}
