<?php

namespace App\Http\Controllers\Api;

use App\Models\Certificate;
use App\Http\Resources\Api\CertificateResource;

class CertificateController extends ApiController
{
    public function __construct()
    {
        $this->model = Certificate::class;
        $this->resource = CertificateResource::class;
    }
}
