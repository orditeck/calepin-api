<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (int) $this->input('author_id') === $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['author_id' => 'required|int|exists:users,id'];
    }
}
