<?php

namespace App\Services;

use App\Interfaces\PersonRepositoryInterface;
use App\Interfaces\TicketRepositoryInterface;
use App\Models\Person;
use App\Models\Ticket;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class TicketService
{
    public function __construct(private PersonRepositoryInterface $personRepository, private TicketRepositoryInterface $ticketRepository)
    {
    }

    /**
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function createTicket(array $data): bool
    {
        $person = $this->personRepository->findByEmail($data['email']);
        if (!$person) {
            $person = $this->personRepository->create(new Person(Arr::only($data, ['name', 'email'])));
        }

        $newTicket = new Ticket();
        $newTicket->person_id = $person->id;
        $newTicket->subject = Arr::get($data, 'subject');
        $newTicket->message = Arr::get($data, 'message');
        $newTicket->due_date = $this->calculateDueDate(9, 17);
        $ticket = $this->ticketRepository->create($newTicket);
        return (bool)$ticket;
    }


    /**
     * @param int $startHour
     * @param int $endHour
     * @return Carbon
     */
    private function calculateDueDate(int $startHour, int $endHour): Carbon
    {
        $dueDate = Carbon::now()->addDays(5)->setTime(10, 0, 0);
        if ($dueDate->isWeekend()) {
            $dueDate->next(Carbon::MONDAY)->addDay()->setTime($endHour, 0);
        } else {

            //Calculate the due date based on  9am to 5pm
            //If the due date is after 5pm then add 1 day
            if ($dueDate->hour >= $endHour) {
                $dueDate->addDays(2)->setTime($endHour, 0);
            }
            //If the due date is before 9am then add 1 day
            if ($dueDate->hour <= $startHour) {
                $dueDate->addDays(1)->setTime($endHour, 0);
            }

            if ($dueDate->hour >= $startHour && $dueDate->hour <= $endHour) {
                $hoursLeftFromToday = $endHour - $dueDate->hour; // How many hours left from today / 7 hours left
                $hoursLeft = 16 - $hoursLeftFromToday; // 9 órám 16 óráig
                if ($hoursLeft <= 8) {
                    $dueDate->nextWeekday()->setTime($startHour + $hoursLeft, 0);
                } else {
                    $dueDate->nextWeekday()->addDay()->setTime(($startHour + $hoursLeft) - 8, 0);
                }
            }
        }
        return $dueDate;
    }
}
