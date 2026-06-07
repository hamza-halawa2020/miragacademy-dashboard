<?php
namespace App\Http\Controllers\Api;

use App\Models\MediaCenter;
use App\Http\Resources\Api\MediaCenterResource;

class MediaCenterController extends ApiController
{
    public function __construct()
    {
        $this->model = MediaCenter::class;
        $this->resource = MediaCenterResource::class;
        $this->filterableFields = ['type'];
    }
}
