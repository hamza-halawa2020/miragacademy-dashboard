<?php

namespace App\Http\Controllers\Api;

use App\Models\MainSlider;
use App\Http\Resources\Api\MainSliderResource;

class MainSliderController extends ApiController
{
    protected bool $paginate = false;

    public function __construct()
    {
        $this->model = MainSlider::class;
        $this->resource = MainSliderResource::class;
    }
}
