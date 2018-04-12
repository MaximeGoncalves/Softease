<?php

namespace App\Policies;

use App\User;
use App\Ticket;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the ticket.
     *
     * @param  \App\User   $user
     * @param  \App\Ticket $ticket
     * @return mixed
     */
    public function view(User $user, Ticket $ticket)
    {
        return $ticket->user_id === $user->id;
    }

    /**
     * Determine whether the user can create tickets.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the ticket.
     *
     * @param  \App\User   $user
     * @param  \App\Ticket $ticket
     * @return mixed
     */
    public function update(User $user, Ticket $ticket)
    {
        return Auths::user()->hasRole('ROLE_ADMIN');
    }

    /**
     * Determine whether the user can delete the ticket.
     *
     * @param  \App\User   $user
     * @param  \App\Ticket $ticket
     * @return mixed
     */
    public function delete(User $user, Ticket $ticket)
    {
        return $user->hasRole('ROLE_ADMIN');
    }

    public function before(User $user)
    {
        if ($user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_TECHNICIAN')):
            return true;
        endif;
    }
}