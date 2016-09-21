<?php

namespace Pilaster\Newsletters\Controllers;

use Illuminate\Http\Request;
use Pilaster\Newsletters\Newsletter;

class DashboardController extends Controller
{
    /**
     * Display the dashboard
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $newsletters = Newsletter::with('campaigns')->get();

        return view('newsletters::dashboard', compact('newsletters'));
    }
}
