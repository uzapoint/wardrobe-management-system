<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string",
            "category" => "required|in:shirt,trouser,jacket,shoes",
            "size" => "required|in:xs,s,m,l,xl",
            "color" => "required|in:red,blue,black,white",
            "image" => "nullable|image"
        ];
    }
}
