<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTicketIsValid
{
    public function handle(Request $request, Closure $next)
    {
        $validTickets = ['ABC123', 'DEF456', 'GHI789'];

        $ticket = $request->input('ticket');

        if (!in_array($ticket, $validTickets)) {
            abort(403, 'Tiket tidak valid.');
        }

        return $next($request);
    }
}
