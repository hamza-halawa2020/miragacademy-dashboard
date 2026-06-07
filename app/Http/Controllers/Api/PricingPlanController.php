<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\PricingPlanResource;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class PricingPlanController extends ApiController
{
    public function __construct()
    {
        $this->model = PricingPlan::class;
        $this->resource = PricingPlanResource::class;
        $this->paginate = false;
    }

    public function index(Request $request)
    {
        $plans = PricingPlan::query()
            ->active()
            ->orderBy('sort_order')
            ->orderBy('price')
            ->get();

        return PricingPlanResource::collection($plans);
    }
}
