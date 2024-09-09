<?php

namespace App\Services;

use App\Models\PromoCode;

class PromoCodeDiscountService
{
    private object $promoCode;
    public array $sums;


    public function apply($promo_code, $sums)
    {
        $this -> promo_code = $promo_code;
        $this -> sums = $sums;
        $this -> promoCode = PromoCode::where('name', $this->promo_code) -> firstOrFail();
        $this -> promoCode -> max_count--;
        $this -> promoCode -> save();

        foreach ($this->sums as $key => $sum) {
             $this -> sums[$key] = $this -> calculateDiscount($sum);
        }

        return $this -> sums;
    }

    private function calculateDiscount($sum)
    {
        if($this -> promoCode -> discount_type  === 'rubles') {
            $sum = $sum - $this -> promoCode -> discount;
            if($sum < 0) {
                $sum = 0;
            }
        } else {
            $sum = $sum - ($sum * ($this -> promoCode -> discount / 100));
        }

        return $sum;
    }


}
