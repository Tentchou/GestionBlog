<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
        if(request()->routeIs('posts.store')){
            $imageRule = 'image|required';
        }elseif(request()->routeIs('posts.update')){
            $imageRule = 'image|sometimes';
        }
        return [
            'title'=>'required|min:5|max:50',
            'content'=>'required',
            'image'=>$imageRule,
            'categorie'=>'required',
            

            //
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->image == null) {
            $this->request->remove('image');
        }
    }
}
