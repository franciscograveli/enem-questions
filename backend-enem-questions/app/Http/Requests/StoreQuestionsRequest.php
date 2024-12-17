<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'questions' => 'required|array',
            'questions.*.category' => 'required|string|max:50',
            'questions.*.dsc_question' => 'required|string',
            'questions.*.answers' => 'required|array|min:2',
            'questions.*.answers.*.dsc_answer' => 'required|string',
            'questions.*.answers.*.is_correct' => 'required|boolean',
        ];
    }

}
