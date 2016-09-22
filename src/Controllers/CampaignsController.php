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
        $lists = MailingList::all();

        return view('newsletters::campaigns.edit', compact('campaign', 'lists'));
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
        $action = 'Updated';

        if ($request->has('send_now')) {
            $campaign = $this->sendCampaign($campaign);
            $action = 'Sent';
        }

        if ($request->has('schedule_now')) {
            $campaign = $this->scheduleCampaign($campaign);
            $action = 'Scheduled';
        }

        session()->flash('success', sprintf('%s campaign %s', $action, $campaign->name));

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
        $campaign = new Campaign();
        $lists = MailingList::all();
        $list = $this->getList($request->input('list'));
        $campaign->list_id = $list ? $list->id : null;

        return view('newsletters::campaigns.create', compact('campaign', 'lists'));
    }

    /**
     * Save a newly created newsletter to the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $campaign = new Campaign($this->campaignAttributesFrom($request));
        $action = 'Created';

        $campaign->addAttachments($request->input('attached_files', []));
        $campaign->save();

        if ($request->has('send_now')) {
            $campaign = $this->sendCampaign($campaign);
            $action = 'Sent';
        }

        if ($request->has('schedule_now')) {
            $campaign = $this->scheduleCampaign($campaign);
            $action = 'Scheduled';
        }

        session()->flash('success', sprintf('%s campaign %s', $action, $campaign->name));

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
     * Send the campaign rite nao!
     *
     * @param \Pilaster\Newsletters\Campaign $campaign
     * @return \Pilaster\Newsletters\Campaign
     */
    private function sendCampaign(Campaign $campaign)
    {
        // TODO: Send campaign now

        return $campaign;
    }

    /**
     * Schedule the campaign to be sent in the future.
     *
     * @param \Pilaster\Newsletters\Campaign $campaign
     * @return \Pilaster\Newsletters\Campaign
     */
    private function scheduleCampaign(Campaign $campaign)
    {
        // TODO: Schedule campaign now

        $campaign->is_scheduled = true;
        $campaign->save();

        return $campaign;
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
            'scheduled_for' => $request->input('scheduled_for') ? new Carbon($request->input('scheduled_for')) : null,
        ];
    }
}
