<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class CreateFormEntryController extends Controller
{
    public function __invoke(): View
    {
        return view('form_entries.create');
    }
}
