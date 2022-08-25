<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class TestUserObserver
{

    // Observer islatish uchun created digani uje sazdat bo'gandan kegingi holat updating digani sozdat bo'vatgan holat
    // yana observer sozdat qiganda Providers EventServiceProvider ichida qo'shob qo'yish kere
    /**
     * Handle the ModelsUser "created" event.
     *
     * @param  \App\Models\User  $modelsUser
     * @return void
     */
    public function created(User $modelsUser)
    {

    }

    /**
     * Handle the ModelsUser "updated" event.
     *
     * @param  \App\Models\User  $modelsUser
     * @return void
     */
    public function updating(User $modelsUser)
    {
        $test[] = $modelsUser->isDirty();
        $key = 1;
        Cache::forget($key);
    }

    /**
     * Handle the ModelsUser "deleted" event.
     *
     * @param  \App\Models\User  $modelsUser
     * @return void
     */
    public function deleted(User $modelsUser)
    {
        //
    }

    public function deleting(User $modelsUser)
    {
        //
    }

    /**
     * Handle the ModelsUser "restored" event.
     *
     * @param  \App\Models\User  $modelsUser
     * @return void
     */
    public function restored(User $modelsUser)
    {
        //
    }

    /**
     * Handle the ModelsUser "force deleted" event.
     *
     * @param  \App\Models\User  $modelsUser
     * @return void
     */
    public function forceDeleted(User $modelsUser)
    {
        //
    }
}
