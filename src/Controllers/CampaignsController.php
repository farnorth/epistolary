<?php

namespace Pilaster\Newsletters\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Pilaster\Newsletters\Campaign;
use Pilaster\Newsletters\MailingList;

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
        $campaign = Campaign::find($campaign_id);

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
        $campaign = Campaign::find($campaign_id);

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
        $campaign = Campaign::find($campaign_id);
        $campaign->update($this->campaignAttributesFrom($request));

        session()->flash('success', sprintf('Updated campaign %s', $campaign->name));

        return redirect()->route('newsletters::campaigns.index');
    }

    /**
     * Show the form to create a new newsletter.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $lists = MailingList::all();
        $list = $this->getList($request->input('list'));
        $for_list = $list ? $list->id : null;

        return view('newsletters::campaigns.create', compact('lists', 'for_list'));
    }

    /**
     * Save a newly created newsletter to the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $campaign = Campaign::create($this->campaignAttributesFrom($request));

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
        $campaign = Campaign::find($campaign_id);
        $campaign->delete();

        session()->flash('success', sprintf('Deleted campaign %s', $campaign->name));

        return redirect()->route('newsletters::campaigns.index');
    }

    /**
     * Get a mailing list by its ID or slug.
     *
     * @param int|string $list
     * @return \Pilaster\Newsletters\MailingList
     */
    private function getList($list)
    {
        if (is_numeric($list)) {
            return MailingList::find($list);
        }

        return MailingList::getBySlug($list);
    }

    /**
     * Build the array of attributes for a newsletter from a request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private function campaignAttributesFrom(Request $request)
    {
        return [
            'list_id' => $request->input('list_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'send_at' => $request->input('send_at') ? new Carbon($request->input('send_at')) : null,
        ];
    }
}
