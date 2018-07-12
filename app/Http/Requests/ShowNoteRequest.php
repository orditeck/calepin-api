<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return (
            $this->route('note')->public ||
            ($this->user('api') && $this->route('note')->author_id === $this->user('api')->id)
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [];
    }
}
