<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':

            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    // UPDATE ROLES
                    'title' => 'required|min:3',
                    'body' => 'required|min:5',
                    'category_id' => 'required|numeric',
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
    }

    public function messages()
    {
        return [
            // Validation messages
            'title.min' => '标题必须3个字符以上',
            'body.min' => '内容必须5个字符以上',
        ];
    }
}
