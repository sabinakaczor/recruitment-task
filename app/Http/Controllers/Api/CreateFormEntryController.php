<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateFormEntryRequest;
use App\Http\Resources\FormEntryResource;
use App\Services\FormEntryService;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateFormEntryController extends Controller
{
    public function __construct(
        private FormEntryService $service
    ) {}

    public function __invoke(CreateFormEntryRequest $request): JsonResource
    {
        $model = $this->service->create($request->all());

        return new FormEntryResource($model);
    }
}
