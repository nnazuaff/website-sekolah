<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;

class ContactController extends Controller
{
    public function index()
    {
        $schoolProfile = SchoolProfile::query()->first();
        $mapUrl = $schoolProfile?->address
            ? 'https://www.google.com/maps/search/?api=1&query='.rawurlencode($schoolProfile->address)
            : null;
        $mapEmbedUrl = $schoolProfile?->address
            ? 'https://www.google.com/maps?q='.rawurlencode($schoolProfile->address).'&output=embed'
            : null;

        return view('public.contact.index', compact('schoolProfile', 'mapUrl', 'mapEmbedUrl'));
    }
}
