<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketCreateRequest;
use App\Interfaces\PersonRepositoryInterface;
use App\Interfaces\TicketRepositoryInterface;
use App\Services\TicketService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class TicketingController extends Controller
{

    public function __construct(
        private TicketRepositoryInterface $ticketRepository,
        private PersonRepositoryInterface $personRepository)
    {
    }

    /**
     * @param TicketCreateRequest $request
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function store(TicketCreateRequest $request): Redirector|RedirectResponse|Application
    {

        $ticketService = new TicketService($this->personRepository, $this->ticketRepository);
        $success = $ticketService->createTicket($request->all());

        if ($success) {
            return redirect()->back()->with('success', 'Ticket created successfully');
        }
        return redirect()->back()->with('error', 'Ticket creation failed');
    }
}
