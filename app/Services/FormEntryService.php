<?php

namespace App\Services;

use App\Models\FormEntry;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class FormEntryService
{
    public function create(array $data): FormEntry
    {
        $attachment = Arr::pull($data, 'attachment');

        $model = new FormEntry($data);
        $filename = Storage::putFile('attachments', $attachment);
        $model->attachment = Storage::url($filename);
        $model->save();

        return $model;
    }

    public function list(): Collection
    {
        return FormEntry::all();
    }
}
