<?php

namespace App\Observers;

use App\Models\Badge;
use App\Models\Product;
use App\Models\User;

class ProductObserver
{
    public function created(Product $product)
    {
        User::clearAllAchievements();

        $usersToBeUpdated = collect();

        foreach (Badge::rules() as $rule)
            $rule['users']->each(function ($user) use ($rule, &$usersToBeUpdated) {
                $doesUserQueued = $usersToBeUpdated->where('id', $user->id)->count() > 0;

                $currentUser = $doesUserQueued
                    ? $usersToBeUpdated->where('id', $user->id)->first()
                    : $user;

                if ($doesUserQueued) 
                    $usersToBeUpdated = $usersToBeUpdated->filter(function ($user) use ($currentUser) {
                        return $user->id == $currentUser->id;
                    });

                $achievements = !is_null($currentUser->achievements) 
                    ? $currentUser->achievements : [];

                array_push($achievements, ...Badge::whereIn('slug', $rule['badges'])
                    ->get(['title', 'icon'])->toArray());

                $currentUser->achievements = array_map("unserialize", array_unique(
                    array_map("serialize", $achievements))
                );

                $usersToBeUpdated->push($currentUser);
            });

        $usersToBeUpdated->each(fn($user) => $user->save());
    }
}


// User::getTopByProductCount(10)->each(function (User $user) {
//     $user->achievements = Badge::whereIn('slug', Badge::$rules['PRODUCT_TOP_10'])
//         ->get(['title', 'icon'])->toArray();
    
//     $user->save();
// });

// User::getTopByProductCount(3)->each(function (User $user) {
//     $user->achievements = Badge::whereIn('slug', Badge::$rules['PRODUCT_TOP_3'])
//         ->get(['title', 'icon'])->toArray();
    
//     $user->save();
// });

// User::getTopByProductCount(1)->each(function (User $user) {
//     $user->achievements = Badge::whereIn('slug', Badge::$rules['PRODUCT_TOP_1'])
//         ->get(['title', 'icon'])->toArray();

//     $user->save();
// });
