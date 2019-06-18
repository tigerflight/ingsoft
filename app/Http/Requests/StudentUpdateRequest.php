<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
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
        return
        [
            'rut'=>'required|unique:students,rut'.$this->student,
            'name'=>'required',
            'email'=>'required',
            'phone'=>'nullablle',
            'career'=>'required',
            'work_id'=>'nullable'];
            
        
    }

    public function messages(){
        return [
            
            'rut.unique' => 'Ya existe el rut ingresado.',
            'career.required'=>'El campo Carrera no puede estar vacío',
            'name.required' => 'El campo nombre no puede estar vacío',
            'rut.required' => 'El campo RUT no puede estar vacío',
            'email.required' => 'El campo E-mail no puede estar vacío',
        ];
    }
}
