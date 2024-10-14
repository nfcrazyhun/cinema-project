<?php

namespace App\Http\Requests;

use App\Enums\Language;
use App\Enums\Rating;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'rating' => ['required', Rule::enum(Rating::class)],
            'language' => ['required', Rule::enum(Language::class)],
            'poster' => ['nullable', 'image', 'max:5012'],
        ];
    }
}
