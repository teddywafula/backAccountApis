<?php

namespace App\Http\Requests;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\Balance\BalanceInterface;
use App\Repositories\Withdraw\WithdrawInterface;

class Withdraw extends FormRequest
{
    
    protected $balance;
    protected $withdrawInterface;
    /**
     * WithdrawRequest constructor.
     *
     * @param WithdrawInterface $withdrawInterface
     * @param BalanceInterface $balance
    **/

    public function __construct(
        BalanceInterface $balance,
        WithdrawInterface $withdrawInterface
    )
    {
        $this->balance = $balance;
        $this->withdrawInterface = $withdrawInterface;
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
            'amount' => 'bail|required|numeric|gte:1|lte:20000|amount_balance|maxi_atts|check_balance',
            'amount_balance' =>'lte:'.$this->withdrawInterface->getWithAmountperDay(),
            'maxi_atts' => 'lte:'.$this->withdrawInterface->getWithDrawAttempts(),
            'check_balance' => ''
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
            'amount.gte'  => 'Enter a valid amount',
            'amount_balance' => 'Exceeded Maximum Withdrawal Per day',
            'amount.lte' => 'Exceeded Maximum Withdrawal Per Transaction',
            'maxi_atts' => 'Maximum Attempts made today.Try again later.',
            'check_balance' => "You have insufficient balance."
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
