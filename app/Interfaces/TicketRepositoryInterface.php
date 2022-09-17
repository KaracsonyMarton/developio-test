<?php

namespace App\Interfaces;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

interface TicketRepositoryInterface
{
    public function findById(int $id): Ticket|null;

    public function findAll(): Collection;

    public function findAllForFilter(): Builder;

    public function create(Ticket $ticket): Ticket;

    public function update(int $id, array $ticket_details): Ticket;

    public function deleteById(int $id): bool;
}
