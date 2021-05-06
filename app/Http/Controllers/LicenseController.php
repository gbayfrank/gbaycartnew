<?php

namespace GbayCart\Http\Controllers;

use GbayCart\License;
use Illuminate\Routing\Controller;
use GbayCart\Http\Middleware\RedirectIfShouldNotCreateLicense;

class LicenseController extends Controller
{
    public function __construct()
    {
        $this->middleware(RedirectIfShouldNotCreateLicense::class);
    }

    public function create()
    {
        return view('license.create');
    }

    public function store(License $license)
    {
        request()->validate([
            'purchase_code' => 'required',
        ], [
            'required' => 'The purchase code field is required.',
        ]);

        $license->activate(request('purchase_code'));

        return redirect()->intended();
    }
}
