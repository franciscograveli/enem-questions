<?php

namespace App\Http\Controllers\Api;

use App\Models\Questions;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionsRequest;
use App\Http\Resources\QuestionsResource;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Questions::all();
        return QuestionsResource::collection($questions);
    }

    // public function show($id)
    // {
    //     $question = Questions::find($id);
    //     if (!$question) {
    //         return response()->json(['error' => 'Question not found'], 404);
    //     }
    //     return response()->json($question);
    // }

    public function show($id)
    {
        // Encontra a pergunta pelo ID
        $question = Questions::find($id);

        // Verifica se a pergunta existe
        if (!$question) {
            return response()->json(['error' => 'Question not found'], 404);
        }

        // Obtém as respostas associadas à pergunta
        $answers = $question->answers()->get()->map(function ($answer) {
            return [
                'dsc_answer' => $answer->dsc_answer,
                'is_correct' => $answer->is_correct,
            ];
        });

        // Adiciona as respostas à estrutura da pergunta
        $question['answers'] = $answers;

        // Retorna a resposta com a pergunta e suas respostas
        return response()->json($question);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionsRequest $request)
    {
        $validatedRequest = $request->validated();

        $questions = [];

        foreach ($validatedRequest['questions'] as $questionData) {
            $question = Questions::create([
                'category' => $questionData['category'],
                'dsc_question' => $questionData['dsc_question'],
            ]);

            foreach ($questionData['answers'] as $answer) {
                $question->answers()->create([
                    'dsc_answer' => $answer['dsc_answer'],
                    'is_correct' => $answer['is_correct']
                ]);
            }

            $questions[] = new QuestionsResource($question);
        }

        return response()->json($questions, 201);
    }


    public function update(StoreQuestionsRequest $request, Questions $questions)
    {
        $questions->update($request->validated());
        return new QuestionsResource($questions);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Questions $questions)
    {
        $questions->delete();
        return response(null,204);
    }
}
