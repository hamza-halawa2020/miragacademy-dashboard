<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\CourseResource;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;

class CourseController extends ApiController
{
    protected array $with = ['categoryRelation'];
    protected array $filterableFields = ['course_category_id'];

    public function __construct()
    {
        $this->model = Course::class;
        $this->resource = CourseResource::class;
    }

    public function categories(Request $request)
    {
        $categories = CourseCategory::query()
            ->active()
            ->withCount('courses')
            ->orderBy('created_at')
            ->get()
            ->map(fn (CourseCategory $category) => [
                'id' => $category->id,
                'name' => $category->name,
                'description' => $category->description,
                'image_url' => $category->image ? asset('storage/' . $category->image) : null,
                'courses_count' => $category->courses_count,
            ]);

        return response()->json([
            'data' => $categories,
        ]);
    }
}
