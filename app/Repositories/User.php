<?php namespace App\Repositories;

use App\User as UserModel;

class User {
    public function findByUserNameOrCreate($userData) {
        $user = UserModel::where('provider_id', '=', $userData->id)->first();
        if(!$user) {
            $user = UserModel::create([
                'provider_id' => $userData->id,
                'name' => $userData->name,
                'email' => $userData->email,
                'avatar' => $userData->avatar,
                'active' => 1,
            ]);
        }

        $this->checkIfUserNeedsUpdating($userData, $user);
        return $user;
    }

    public function checkIfUserNeedsUpdating($userData, $user) {

        $socialData = [
            'avatar' => $userData->avatar,
            'email' => $userData->email,
            'name' => $userData->name,
        ];
        $dbData = [
            'avatar' => $user->avatar,
            'email' => $user->email,
            'name' => $user->name,
        ];

        if (!empty(array_diff($socialData, $dbData))) {
            $user->avatar = $userData->avatar;
            $user->email = $userData->email;
            $user->name = $userData->name;
            $user->save();
        }
    }
}