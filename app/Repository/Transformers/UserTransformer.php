<?php
namespace App\Repository\Transformers;

class UserTransformer extends Transformer{
    public function transform($user){
        return [
            'name' => $user->name,
            'member_id' => $user->member_id,
            'mobile_number' => $user->mobile_number,
            'email' => $user->email,
            'family_active' => $user->family,
            'religion_active' => $user->religion,
            'marital_active' => $user->marital,
            'profession_active' => $user->profession,
            'api_token' => $user->api_token,

        ];
    }
}