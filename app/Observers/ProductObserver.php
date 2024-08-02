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

        $rules = Badge::rules();

        foreach ($rules as $rule) {
            $users = $rule['users']->get();
            $badges = Badge::whereIn('slug', $rule['badges'])
                ->get(['title', 'icon'])->toArray();

            foreach ($users as $user) $user->addBadges($badges);
        }
    }
}
