<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookSearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'author' => 'nullable|string',
            'title' => 'nullable|string',

            'isbn' => [
                'nullable',
                'string',
                function ($attribute, $value, $message) {
                    if(Str::startsWith($value, ';')) {
                        $message("{$attribute} must not start with semicolon.");
                    }

                    $isbnValues = explode(';', $value);

                    foreach($isbnValues as $isbn) {
                        $isbnLength = strlen($isbn);

                        if(!in_array($isbnLength, [10, 13])) {
                            $message("{$attribute} must be 10 or 13 characters.");
                        }
                    }
                },
            ],

            'offset' => [
                'nullable',
                'numeric',
                function ($attribute, $value, $message) {
                    if(is_numeric($value) && ($value !== 0 && $value % 20 !== 0)) {
                        $message("{$attribute} must be divisible by 20.");
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'author.string' => 'Author must be a string.',
            'isbn.string' => 'ISBN must be a string.',
            'title.string' => 'Title must be a string.',
            'offset.numeric' => 'Offset must be 0 or an integer divisible by 20.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
