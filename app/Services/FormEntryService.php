<?php

namespace App\Services;

use App\Models\FormEntry;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class FormEntryService
{
    public function create(array $data)
    {
        $attachment = Arr::pull($data, 'attachment');

        $model = new FormEntry($data);
        $model->attachment = Storage::putFile('attachments', $attachment);
        $model->save();

        return $model;
    }
}
