<?php

namespace Pilaster\Newsletters\Controllers;

use Illuminate\Http\Request;
use Pilaster\Newsletters\Newsletter;

class NewslettersController extends Controller
{
    /**
     * Display a listing of newsletters.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $newsletters = Newsletter::all();

        return view('newsletters::newsletters.index', compact('newsletters'));
    }

    /**
     * Show a single newsletter.
     *
     * @param int|string $newsletter_id
     * @return \Illuminate\View\View
     */
    public function show($newsletter_id)
    {
        $newsletter = $this->getNewsletter($newsletter_id);

        return view('newsletters::newsletters.show', compact('newsletter'));
    }

    /**
     * Show the form to edit a newsletter.
     *
     * @param int|string $newsletter_id
     * @return \Illuminate\View\View
     */
    public function edit($newsletter_id)
    {
        $newsletter = $this->getNewsletter($newsletter_id);

        return view('newsletters::newsletters.edit', compact('newsletter'));
    }

    /**
     * Update a newsletter.
     *
     * @param \Illuminate\Http\Request $request
     * @param int|string $newsletter_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $newsletter_id)
    {
        $newsletter = $this->getNewsletter($newsletter_id);
        $newsletter->update($this->newsletterAttributesFrom($request));

        session()->flash('success', sprintf('Updated newsletter %s', $newsletter->name));

        return redirect()->route('newsletters.index');
    }

    /**
     * Show the form to create a new newsletter.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('newsletters::newsletters.create');
    }

    /**
     * Save a newly created newsletter to the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $newsletter = new Newsletter($this->newsletterAttributesFrom($request));
        $newsletter->save();

        session()->flash('success', sprintf('Created newsletter %s', $newsletter->name));

        return redirect()->route('newsletters.index');
    }

    /**
     * Delete a newsletter.
     *
     * @param int|string $newsletter_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($newsletter_id)
    {
        $newsletter = $this->getNewsletter($newsletter_id);
        $newsletter->delete();

        session()->flash('success', sprintf('Deleted newsletter %s', $newsletter->name));

        return redirect()->route('newsletters.index');
    }

    /**
     * Get a newsletter by its ID or slug.
     *
     * @param int|string $newsletter
     * @return \Pilaster\Newsletters\Newsletter
     */
    private function getNewsletter($newsletter)
    {
        if (is_numeric($newsletter)) {
            return Newsletter::find($newsletter);
        }

        return Newsletter::getBySlug($newsletter);
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
            'slug' => str_slug($request->input('name')),
            'description' => $request->input('description'),
            'requires_opt_in' => $request->input('requires_opt_in', true),
        ];
    }
}
