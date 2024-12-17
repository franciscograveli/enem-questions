<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnswersRequest extends FormRequest
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
            'answers' => ['required', 'array'], // Valida se "answers" é um array
            'answers.*.dsc_answer' => ['required', 'string'], // Valida o campo "dsc_answer" em cada item do array
            'answers.*.is_correct' => ['required', 'boolean'], // Valida o campo "is_correct" em cada item do array
        ];
    }
}
