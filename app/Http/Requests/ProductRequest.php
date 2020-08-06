<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $method = $this->method();
        if (null !== $this->get('_method', null)) {
            $method = $this->get('_method');
        }
        $this->offsetUnset('_method');
        switch ($method) {
            case 'PATCH':
                return [
                    'name' => 'required|max:255|exists:products,name',
                    'detail' => 'required',
                    'price' => 'required|max:10',
                    'stock' => 'required|max:6',
                    'discount' => 'required|max:2'
                ];
                break;
            default:
                return [
                'name' => 'required|max:255|unique:products',
                'detail' => 'required',
                'price' => 'required|max:10',
                'stock' => 'required|max:6',
                'discount' => 'required|max:2'
            ];
                break;
        }        
    }
}
