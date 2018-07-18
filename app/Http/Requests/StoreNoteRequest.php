<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'author_id' => 'required|integer|exists:users,id',
            'title' => 'required|max:100',
            'content' => 'required',
            'language' => 'required|max:50',
            'public' => 'boolean',
            'encrypted' => 'boolean'
        ];
    }
}
