<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
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
        $job_id = $this->job_id;
        return [
            'id'                                => [
                                                      'sometimes',
                                                      Rule::exists('applications', 'id')->where(function ($query) {
                                                          $query->where('user_id', auth()->user()->id);
                                                      }),
                                                    ],
            'job_id'                            => [
                                                    'required',
                                                    Rule::exists('jobs', 'id')->where(function ($query) use ($job_id) {
                                                        $query->where('id', $job_id);
                                                    }),
                                                    ],
            'email'                              => [
                                                    'required',
                                                    'max:100',
                                                    Rule::unique('applications', 'email')
                                                        ->ignore($this->id, 'id')
                                                        ->where(function ($query) use ($job_id) {
                                                            $query->where('job_id', $job_id);
                                                        }),
                                                    ],
            'web_address'                       => 'sometimes|required|string|max:100',
            'cover'                             => 'string|nullable',
        ];
    }
}
