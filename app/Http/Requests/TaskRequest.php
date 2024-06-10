<?php

namespace App\Http\Requests; // Defines the namespace of the TaskRequest class

use Illuminate\Foundation\Http\FormRequest; // Imports the FormRequest class from Laravel

class TaskRequest extends FormRequest // Declares the TaskRequest class which extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // This method always returns true, meaning any user is authorized to make the request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string', // Title field must be present and a string
            'description' => 'required|string|min:5|max:500', // Description field must be present, a string, and have a length between 5 and 500 characters
        ];
    }
}
