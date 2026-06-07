<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\StaffResource;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends ApiController
{
    public function __construct()
    {
        $this->model = Staff::class;
        $this->resource = StaffResource::class;
    }

    public function index(Request $request)
    {
        $query = $this->model::with($this->with)->orderBy('id', 'asc');

        if (method_exists(new $this->model, 'scopeActive')) {
            $query->active();
        }

        foreach ($this->filterableFields as $field) {
            if ($request->has($field) && $request->get($field) !== null && $request->get($field) !== 'all') {
                $query->where($field, $request->get($field));
            }
        }

        if ($this->paginate) {
            $items = $query->paginate($request->get('limit', $this->perPage));
        } else {
            $items = $query->get();
        }

        return $this->resource::collection($items);
    }
}
