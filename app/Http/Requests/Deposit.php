<?php

namespace App\Http\Requests;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Repositories\Deposit\DepositInterface;
use Illuminate\Foundation\Http\FormRequest;

class Deposit extends FormRequest
{
    
    protected $depositInterface;

    /**
     * DepositInterface constructor.
     *
     * @param DepositInterface $depositInterface
     * 
    **/

    public function __construct(
        DepositInterface $depositInterface
    )
    {
        $this->depositInterface = $depositInterface;
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'amount' => 'bail|required|numeric|gte:1|lte:40000|maxim_deposit|amount_nums:',
            'maxim_deposit' =>'lte:'.$this->depositInterface->getDepAmountperDay(),
            'amount_nums' => 'lte:'.$this->depositInterface->getAttempts(),
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
            'amount.required'  => 'Amount is required',
            'maxim_deposit' => "Exceeded Maximum Deposit Per day",
            'amount_nums' => "Exceeded maximum attempts today.Try again later",
            'amount.lte' => 'Exceeded Maximum Deposit Per Transaction',
        ];
    }

    

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();        
        throw new HttpResponseException(response()->json($errors['amount'][0]
        , JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
