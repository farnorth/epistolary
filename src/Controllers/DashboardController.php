<?php

namespace Pilaster\Epistolary\Controllers;

use Pilaster\Epistolary\MailingList;

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

        return view('epistolary::dashboard', compact('lists'));
    }
}
