<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;

class ContactController extends Controller
{
    public function index()
    {
        $schoolProfile = SchoolProfile::query()->first();
        $mapUrl = $schoolProfile
            ? 'https://www.google.com/maps?cid=13464426356069005498&g_mp=CiVnb29nbGUubWFwcy5wbGFjZXMudjEuUGxhY2VzLkdldFBsYWNlEAMYASAF&hl=en-US&source=embed'
            : null;
        $mapEmbedUrl = $schoolProfile
            ? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.0037116566327!2d107.5475813!3d-7.008844799999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ee9f1c88006d%3A0xbadb406ee9e678ba!2sSMK%20Negeri%201%20Katapang!5e0!3m2!1sen!2sid!4v1788779067266!5m2!1sen!2sid'
            : null;

        return view('public.contact.index', compact('schoolProfile', 'mapUrl', 'mapEmbedUrl'));
    }
}
