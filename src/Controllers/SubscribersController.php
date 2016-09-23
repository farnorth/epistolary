<?php

namespace Pilaster\Newsletters\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Pilaster\Newsletters\Requests\SubscriberRequest;
use Pilaster\Newsletters\Subscriber;
use Pilaster\Newsletters\MailingList;
use Pilaster\Newsletters\Subscription;

class SubscribersController extends Controller
{
    /**
     * Display a listing of subscribers.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $subscribers = $this->paginateModel(Subscriber::class, $request);

        return view('newsletters::subscribers.index', compact('subscribers'));
    }

    /**
     * Show a single subscriber.
     *
     * @param int|string $subscriber_id
     * @return \Illuminate\View\View
     */
    public function show($subscriber_id)
    {
        $subscriber = Subscriber::find($subscriber_id);

        return view('newsletters::subscribers.show', compact('subscriber'));
    }

    /**
     * Show the form to edit a subscriber.
     *
     * @param int|string $subscriber_id
     * @return \Illuminate\View\View
     */
    public function edit($subscriber_id)
    {
        $subscriber = Subscriber::find($subscriber_id);
        $subscriber->load('subscriptions');
        $lists = MailingList::all();

        return view('newsletters::subscribers.edit', compact('subscriber', 'lists'));
    }

    /**
     * Update a subscriber.
     *
     * @param \Pilaster\Newsletters\Requests\SubscriberRequest $request
     * @param int|string $subscriber_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SubscriberRequest $request, $subscriber_id)
    {
        $subscriber = Subscriber::find($subscriber_id);
        $subscriber->update($this->subscriberAttributesFrom($request));
        $this->makeSubscriptionsFromRequest($request, $subscriber_id);

        session()->flash('success', sprintf('Updated subscriber %s', $subscriber->email));

        return redirect()->route('newsletters::subscribers.index');
    }

    /**
     * Show the form to create a new subscriber.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $subscriber = new Subscriber();
        $lists = MailingList::all();

        return view('newsletters::subscribers.create', compact('subscriber', 'lists'));
    }

    /**
     * Save a newly created subscriber to the database.
     *
     * @param \Pilaster\Newsletters\Requests\SubscriberRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SubscriberRequest $request)
    {
        $subscriber = Subscriber::create($this->subscriberAttributesFrom($request));
        $this->makeSubscriptionsFromRequest($request, $subscriber->id);

        session()->flash('success', sprintf('Created subscriber %s', $subscriber->email));

        return redirect()->route('newsletters::subscribers.index');
    }

    /**
     * Delete a subscriber.
     *
     * @param int|string $subscriber_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($subscriber_id)
    {
        $subscriber = Subscriber::find($subscriber_id);
        $subscriber->delete();

        session()->flash('success', sprintf('Deleted subscriber %s', $subscriber->name));

        return redirect()->route('newsletters::subscribers.index');
    }

    /**
     * Build the array of attributes for a subscriber from a request.
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

    /**
     * Create subscriptions for a subscriber from a request.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $subscriber_id
     * @return \Illuminate\Support\Collection
     */
    private function makeSubscriptionsFromRequest(Request $request, $subscriber_id)
    {
        return collect($request->input('list_id', []))->map(function ($list_id) use ($subscriber_id) {
            return Subscription::firstOrCreate([
                'list_id' => $list_id,
                'subscriber_id' => $subscriber_id,
            ], [
                'list_id' => $list_id,
                'subscriber_id' => $subscriber_id,
                'opted_in' => true,
                'opted_in_at' => Carbon::now()
            ]);
        });
    }
}
