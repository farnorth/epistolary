<?php

namespace Pilaster\Epistolary\Controllers;

use Illuminate\Http\Request;
use Pilaster\Epistolary\MailingList;
use Pilaster\Epistolary\Services\NewsletterStats;

class ListsController extends Controller
{
    /**
     * Display a listing of mailing lists.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $lists = MailingList::all();

        return view('epistolary::lists.index', compact('lists'));
    }

    /**
     * Show a single mailing list.
     *
     * @param int|string $list_id
     * @return \Illuminate\View\View
     */
    public function show($list_id)
    {
        $list = $this->getList($list_id);
        $list->load('campaigns');

        if (config('epistolary.stats.on')) {
            $stats = app(NewsletterStats::class);
            $eventTotals = $stats->eventTotalsForTag($list->slug);
            $opens = $eventTotals['opened'];
            $clicks = $eventTotals['clicked'];
        } else {
            $opens = 0;
            $clicks = 0;
        }

        return view('epistolary::lists.show', compact('list', 'opens', 'clicks'));
    }

    /**
     * Show the form to edit a mailing list.
     *
     * @param int|string $list_id
     * @return \Illuminate\View\View
     */
    public function edit($list_id)
    {
        $list = $this->getList($list_id);

        return view('epistolary::lists.edit', compact('list'));
    }

    /**
     * Update a newsletter.
     *
     * @param \Illuminate\Http\Request $request
     * @param int|string $list_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $list_id)
    {
        $list = $this->getList($list_id);
        $list->update($this->listAttributesFrom($request));

        session()->flash('success', sprintf('Updated list %s', $list->name));

        return redirect()->route('epistolary::lists.index');
    }

    /**
     * Show the form to create a new newsletter.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $list = new MailingList();

        return view('epistolary::lists.create', compact('list'));
    }

    /**
     * Save a newly created newsletter to the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $list = new MailingList($this->listAttributesFrom($request));
        $list->save();

        session()->flash('success', sprintf('Created list %s', $list->name));

        return redirect()->route('epistolary::lists.index');
    }

    /**
     * Delete a newsletter.
     *
     * @param int|string $list_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($list_id)
    {
        $list = $this->getList($list_id);
        $list->delete();

        session()->flash('success', sprintf('Deleted newsletter %s', $list->name));

        return redirect()->route('epistolary::lists.index');
    }

    /**
     * Get a newsletter by its ID or slug.
     *
     * @param int|string $list
     * @return \Pilaster\Epistolary\MailingList
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
    private function listAttributesFrom(Request $request)
    {
        return [
            'name' => $request->input('name'),
            'slug' => str_slug($request->input('name')),
            'from_email' => $request->input('from_email'),
            'from_name' => $request->input('from_name'),
            'description' => $request->input('description'),
            'requires_opt_in' => $request->input('requires_opt_in', true),
        ];
    }
}
