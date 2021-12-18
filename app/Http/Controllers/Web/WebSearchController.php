<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Models\Page;

class WebSearchController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \Models\Page  $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Page $page)
    {
        $data['current'] = $page;

        // do whatever you want

        return view('web.search', $data);
    }
}
