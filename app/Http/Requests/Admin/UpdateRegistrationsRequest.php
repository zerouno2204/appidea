<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRegistrationsRequest extends FormRequest
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
            
            'data_emissione' => 'nullable|date_format:'.config('app.date_format'),
            'data_scadenza' => 'nullable|date_format:'.config('app.date_format'),
            'id_tipo_doc' => 'max:2147483647|nullable|numeric',
        ];
    }
}