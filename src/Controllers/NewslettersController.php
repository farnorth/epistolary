<?php

namespace Pilaster\Newsletters\Controllers;

use Illuminate\Http\Request;
use Pilaster\Newsletters\List;

class ListsController extends Controller
{
    /**
     * Display a listing of newsletters.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $lists = List::all();

        return view('newsletters::lists.index', compact('newsletters'));
    }

    /**
     * Show a single newsletter.
     *
     * @param int|string $list_id
     * @return \Illuminate\View\View
     */
    public function show($list_id)
    {
        $list = $this->getList($list_id);

        return view('newsletters::lists.show', compact('newsletter'));
    }

    /**
     * Show the form to edit a newsletter.
     *
     * @param int|string $list_id
     * @return \Illuminate\View\View
     */
    public function edit($list_id)
    {
        $list = $this->getList($list_id);

        return view('newsletters::lists.edit', compact('newsletter'));
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
        $list->update($this->newsletterAttributesFrom($request));

        session()->flash('success', sprintf('Updated newsletter %s', $list->name));

        return redirect()->route('newsletters::lists.index');
    }

    /**
     * Show the form to create a new newsletter.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('newsletters::lists.create');
    }

    /**
     * Save a newly created newsletter to the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $list = new List($this->newsletterAttributesFrom($request));
        $list->save();

        session()->flash('success', sprintf('Created newsletter %s', $list->name));

        return redirect()->route('newsletters::lists.index');
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

        return redirect()->route('newsletters::lists.index');
    }

    /**
     * Get a newsletter by its ID or slug.
     *
     * @param int|string $list
     * @return \Pilaster\Newsletters\List
     */
    private function getList($list)
    {
        if (is_numeric($list)) {
            return List::find($list);
        }

        return List::getBySlug($list);
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
