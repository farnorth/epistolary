<?php

namespace Pilaster\Newsletters\Controllers;

use Pilaster\Newsletters\MailingList;

class DashboardController extends Controller
{
    /**
     * Display the dashboard
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $lists = MailingList::with('campaigns')->get();

        return view('newsletters::dashboard', compact('lists'));
    }
}
