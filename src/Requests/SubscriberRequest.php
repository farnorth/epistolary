<?php

namespace Pilaster\Newsletters\Requests;

class SubscriberRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:255',
            'first_name' => 'required|max:255',
            'opted_in' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'list_id.required' => 'You must select at least one Mailing List',
            'opted_in.required' => 'You can\'t add people to a mailing list without their permission',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
