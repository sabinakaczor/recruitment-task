<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\FormEntryService;
use Illuminate\Contracts\View\View;

class ListFormEntriesController extends Controller
{
    public function __construct(
        private FormEntryService $service
    ) {}

    public function __invoke(): View
    {
        $data = $this->service->list();

        return view('form_entries.list', [
            'entries' => $data
        ]);
    }
}
