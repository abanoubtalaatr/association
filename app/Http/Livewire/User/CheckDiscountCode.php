<?php

namespace App\Http\Livewire\User;

use App\Models\Discount;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CheckDiscountCode extends Component
{
    public $discount_code;
    public $ad;
    public $adBeforeDiscount;
    public $adAfterDiscount;

    public function getRules()
    {
        $rules = [
            'discount_code' => [
                'nullable',
                'exists:discounts,discount_code',
            ]
        ];
        return $rules;
    }

    public function check()
    {
        $this->validate();

        if (isset($this->discount_code) && !empty($this->discount_code)) {
            $discount = Discount::where('discount_code', $this->discount_code)
                ->whereDate('expire_at', '>', Carbon::today())
                ->orWhere('number_of_times', 0)
                ->first();
            if (!$discount) {
                Session::flash('error_message_for_discount_code', trans('general.invalid_discount_code'));
            } else {
                //valid code
                Session::put("user_discount", $this->discount_code);

                //calculate ad budget before and after discount
                $this->calculateAdBudgetBeforeAndAfterDiscount($discount);

                Session::flash('valid_message_for_discount_code', trans('general.valid_discount_code'));
            }
        }

    }

    public function calculateAdBudgetBeforeAndAfterDiscount($discount)
    {
//        Session::flash('ad_budget_before_discount', $this->ad->budget);

        $this->adBeforeDiscount = $this->ad->budget;
//        $this->reset('adBeforeDiscount', $this->ad->budget);
        if ($discount->type == 'percentage') {
            $discountValue = ($discount->value / 100) * $this->ad->budget;
            //if discount cover all budget
            if (($this->ad->budget - $discountValue) <= 0) {
                Session::flash('ad_budget_after_discount', 0);
                $this->adAfterDiscount = 0;
            } else {
                Session::flash('ad_budget_after_discount', $this->ad->budget - $discountValue);
                $this->adAfterDiscount = $this->ad->budget - $discountValue;
            }
        } else {
            $discountValue = $this->ad->budget - $discount->value;

            if (($this->ad->budget - $discountValue) <= 0) {
                $this->adAfterDiscount = 0;
                Session::flash('ad_budget_after_discount', 0);
            } else {
                $this->adAfterDiscount = $this->ad->budget - $discountValue;
                Session::flash('ad_budget_after_discount', $this->ad->budget - $discountValue);
            }
        }
    }

    public function render()
    {
        return view('livewire.user.check-discount-code');
    }
}
