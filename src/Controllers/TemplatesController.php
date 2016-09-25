<?php

namespace Pilaster\Epistolary\Controllers;

use Illuminate\Http\Request;
use Pilaster\Epistolary\Subscriber;
use Pilaster\Epistolary\MailingList;

class TemplatesController extends Controller
{
    /**
     * Display a listing of newsletters.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $subscribers = Subscriber::all();

        return view('epistolary::subscribers.index', compact('subscribers'));
    }

    /**
     * Show a single newsletter.
     *
     * @param int|string $subscriber_id
     * @return \Illuminate\View\View
     */
    public function show($subscriber_id)
    {
        $subscriber = Subscriber::find($subscriber_id);

        return view('epistolary::subscribers.show', compact('subscriber'));
    }

    /**
     * Show the form to edit a newsletter.
     *
     * @param int|string $subscriber_id
     * @return \Illuminate\View\View
     */
    public function edit($subscriber_id)
    {
        $subscriber = Subscriber::find($subscriber_id);

        return view('epistolary::subscribers.edit', compact('subscriber'));
    }

    /**
     * Update a newsletter.
     *
     * @param \Illuminate\Http\Request $request
     * @param int|string $subscriber_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $subscriber_id)
    {
        $subscriber = Subscriber::find($subscriber_id);
        $subscriber->update($this->subscriberAttributesFrom($request));

        session()->flash('success', sprintf('Updated subscriber %s', $subscriber->email));

        return redirect()->route('epistolary::subscribers.index');
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

        return view('epistolary::subscribers.create', compact('lists', 'for_list'));
    }

    /**
     * Save a newly created newsletter to the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $subscriber = Subscriber::create($this->subscriberAttributesFrom($request));

        session()->flash('success', sprintf('Created subscriber %s', $subscriber->email));

        return redirect()->route('epistolary::subscribers.index');
    }

    /**
     * Delete a newsletter.
     *
     * @param int|string $subscriber_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($subscriber_id)
    {
        $subscriber = Subscriber::find($subscriber_id);
        $subscriber->delete();

        session()->flash('success', sprintf('Deleted subscriber %s', $subscriber->name));

        return redirect()->route('epistolary::subscribers.index');
    }

    /**
     * Get a mailing list by its ID or slug.
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
    private function subscriberAttributesFrom(Request $request)
    {
        return [
            'email' => $request->input('email'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
        ];
    }
}
