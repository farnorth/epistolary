<?php

namespace Pilaster\Epistolary\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Pilaster\Epistolary\Campaign;
use Pilaster\Epistolary\Jobs\SendCampaign;
use Pilaster\Epistolary\MailingList;
use Pilaster\Epistolary\Requests\CampaignRequest;
use Pilaster\Epistolary\Services\NewsletterStats;

class CampaignsController extends Controller
{
    /**
     * Display a listing of campaigns.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $campaigns = $this->paginateModel(Campaign::class, $request);

        return view('epistolary::campaigns.index', compact('campaigns'));
    }

    /**
     * Show a single campaign.
     *
     * @param int|string $campaign_id
     * @return \Illuminate\View\View
     */
    public function show($campaign_id)
    {
        $campaign = Campaign::find($campaign_id);

        if (config('epistolary.stats.on')) {
            $stats = app(NewsletterStats::class);
            $eventTotals = $stats->eventTotalsForTag(str_slug($campaign->name));
            $opens = $eventTotals['opened'];
            $clicks = $eventTotals['clicked'];
        } else {
            $opens = 0;
            $clicks = 0;
        }

        return view('epistolary::campaigns.show', compact('campaign', 'opens', 'clicks'));
    }

    /**
     * Show the form to edit a campaign.
     *
     * @param int|string $campaign_id
     * @return \Illuminate\View\View
     */
    public function edit($campaign_id)
    {
        $campaign = Campaign::find($campaign_id);
        $lists = MailingList::all();
        $default_time = $this->getDefaultTime($campaign);

        return view('epistolary::campaigns.edit', compact('campaign', 'lists', 'default_time'));
    }

    /**
     * Update a campaign.
     *
     * @param \Pilaster\Epistolary\Requests\CampaignRequest $request
     * @param int|string $campaign_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CampaignRequest $request, $campaign_id)
    {
        $campaign = Campaign::find($campaign_id);
        $campaign->update($this->campaignAttributesFrom($request));
        $action = 'Updated';

        // Is the campaign scheduled to be sent in the future?
        if ($campaign->is_scheduled && !empty($campaign->scheduled_for)) {
            $action = 'Scheduled';
        }

        // Is the campaign being sent now?
        if ($request->has('send_now')) {
            $this->dispatch(new SendCampaign($campaign));
            $action = 'Queued';
        }

        session()->flash('success', sprintf('%s campaign %s', $action, $campaign->name));

        return redirect()->route('epistolary::campaigns.index');
    }

    /**
     * Show the form to create a new campaign.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $campaign = new Campaign();
        $campaign->list_id = $request->input('list_id');
        $lists = MailingList::all();
        $default_time =  $this->getDefaultTime($campaign);

        return view('epistolary::campaigns.create', compact('campaign', 'lists', 'default_time'));
    }

    /**
     * Save a newly created campaign to the database.
     *
     * @param \Pilaster\Epistolary\Requests\CampaignRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CampaignRequest $request)
    {
        $campaign = new Campaign();
        $campaign->fill($this->campaignAttributesFrom($request));
        $action = 'Created';

        $campaign->addAttachments($request->input('attached_files', []));
        $campaign->save();

        // Is the campaign scheduled to be sent in the future?
        if ($campaign->is_scheduled && !empty($campaign->scheduled_for)) {
            $action = 'Scheduled';
        }

        // Is the campaign being sent now?
        if ($request->has('send_now')) {
            $this->dispatch(new SendCampaign($campaign));
            $action = 'Queued';
        }

        session()->flash('success', sprintf('%s campaign %s', $action, $campaign->name));

        return redirect()->route('epistolary::campaigns.index');
    }

    /**
     * Delete a campaign.
     *
     * @param int|string $campaign_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($campaign_id)
    {
        $campaign = Campaign::find($campaign_id);
        $campaign->delete();

        session()->flash('success', sprintf('Deleted campaign %s', $campaign->name));

        return redirect()->route('epistolary::campaigns.index');
    }

    /**
     * Build the array of attributes for a campaign from a request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private function campaignAttributesFrom(Request $request)
    {
        return [
            'name' => $request->input('name'),
            'list_id' => $request->input('list_id'),
            'subject' => $request->input('subject'),
            'description' => $request->input('description'),
            'is_scheduled' => (bool) $request->input('is_scheduled', false),
            'scheduled_for' => $request->input('scheduled_for') ? new Carbon($request->input('scheduled_for')) : null,
            'attachments' => array_merge(
                $request->input('attachments', []),
                $request->input('attached_files', [])
            ),
        ];
    }

    /**
     * Get the default time timestamp to set the schedule to.
     *
     * @param \Pilaster\Epistolary\Campaign $campaign
     * @return int
     */
    private function getDefaultTime(Campaign $campaign)
    {
        old('scheduled_for', ($campaign->scheduled_for ? $campaign->scheduled_for->timestamp : time()));

        return !empty($defaultTime) ? $defaultTime : time();
    }
}
