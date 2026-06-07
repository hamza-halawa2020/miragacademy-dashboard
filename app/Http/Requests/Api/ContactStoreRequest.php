<?php

namespace App\Http\Requests\Api;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ContactStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'age' => 'required|integer|min:1|max:120',
            'country' => 'required|string|max:255',
            'course_category_id' => 'required|exists:course_categories,id',
            'course' => 'required|exists:courses,id',
            'pricing_plan_id' => 'nullable|exists:pricing_plans,id',
            'message' => 'required|string|min:10',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $courseId = (int) $this->input('course');
            $categoryId = (int) $this->input('course_category_id');

            if (! $courseId || ! $categoryId) {
                return;
            }

            $matches = Course::query()
                ->whereKey($courseId)
                ->where('course_category_id', $categoryId)
                ->exists();

            if (! $matches) {
                $validator->errors()->add('course', 'The selected course does not belong to the selected category.');
            }
        });
    }
}