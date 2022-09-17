<?php

namespace App\Repositories;

use App\Interfaces\TicketRepositoryInterface;
use App\Models\Ticket;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TicketRepository implements TicketRepositoryInterface
{
    /**
     * @param Ticket $model
     */
    public function __construct(private Ticket $model)
    {
    }

    /**
     * @param int $id
     * @return Ticket|null
     */
    public function findById(int $id): Ticket|null
    {
        return $this->model->find($id);
    }

    /**
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * @return Builder
     */
    public function findAllForFilter(): Builder
    {
        return $this->model->query();
    }

    /**
     * @param Ticket $ticket
     * @return Ticket
     */
    public function create(Ticket $ticket): Ticket
    {
        $ticket->save();
        return $ticket;
    }

    /**
     * @param int $id
     * @param array $ticket_details
     * @return Ticket
     * @throws Exception
     */
    public function update(int $id, array $ticket_details): Ticket
    {
        $actualTicket = $this->findById($id);
        if (!$actualTicket) {
            throw new Exception('Ticket not found by id');
        }
        $actualTicket->update($ticket_details);

        return $actualTicket;
    }


    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function deleteById(int $id): bool
    {
        $actualTicket = $this->findById($id);
        if (!$actualTicket) {
            throw new Exception('Ticket not found by id');
        }
        return $actualTicket->delete();
    }
}
