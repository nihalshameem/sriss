<?php
namespace App\Repository\Transformers;

class UserTransformer extends Transformer{
    public function transform($user){
        return [
            'name' => $user->name,
            'member_id' => $user->member_id,
            'mobile_number' => $user->mobile_number,
            'email' => $user->email,
            'profile_active' => $user->profile,
            'referral_active' => $user->referral_active,
            'api_token' => $user->api_token,

        ];
    }
}