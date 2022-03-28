<?php

namespace App\Rules\Promotions;

use App\Enums\PromotionType;
use App\Models\Member;
use App\Models\Promotion;
use Illuminate\Contracts\Validation\Rule;

class ValidatePromotionType implements Rule
{
    protected Member $member;

    protected Promotion $promotion;

    protected $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Member $member, Promotion $promotion)
    {
        $this->member = $member;
        $this->promotion = $promotion;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $n_times = $this->promotion->setting->allowed_n_times;

        if (
            $this->promotion->isPromotionType(PromotionType::OneTime) &&
            $this->member->countPromoUsage($this->promotion) >= 1
        ) {
            $this->message = 'You are only allowed to use this once';
            return false;
        }

        if (
            $this->promotion->isPromotionType(PromotionType::Daily) &&
            $this->member->countPromoUsageForTheDay($this->promotion, now()) >= $n_times
        ) {
            $this->message = "You are only allowed to use this {$n_times} times in a day";
            return false;
        }

        if (
            $this->promotion->isPromotionType(PromotionType::Weekly) &&
            $this->member->countPromoUsageForTheWeek($this->promotion, now()) >= $n_times
        ) {
            $this->message = "You are only allowed to use this {$n_times} times in a week";
            return false;
        }

        if (
            $this->promotion->isPromotionType(PromotionType::Monthly) &&
            $this->member->countPromoUsageForTheMonth($this->promotion, now()) >= $n_times
        ) {
            $this->message = "You are only allowed to use this {$n_times} times in a month";
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
