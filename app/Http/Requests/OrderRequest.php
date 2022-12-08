<?php

namespace App\Http\Requests;

use App\Models\Bond;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'bond_id' => request()->id,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $bond = Bond::find($this->bond_id);

        return [
            'bond_id' => 'required|integer|exists:bonds,id',
            'order_date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:' . $bond->issue_date,
                'before_or_equal:' . $bond->last_circulation_date,
            ],
            'number_received' => 'required|integer'
        ];
    }
}
