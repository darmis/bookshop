<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Book;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given book can be updated by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, Book $book)
    {
        return auth()->id() == $book->user_id || auth()->user()->role == 'admin'
                    ? Response::allow()
                    : Response::deny('You cannot edit this book.');
    }

    /**
     * Determine if the given book can be deleted by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(User $user, Book $book)
    {
        return auth()->id() == $book->user_id || auth()->user()->role == 'admin'
                    ? Response::allow()
                    : Response::deny('You cannot delete this book.');
    }
}
