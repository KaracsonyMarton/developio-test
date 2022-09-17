<?php

namespace App\Services;

use App\Interfaces\PersonRepositoryInterface;
use App\Interfaces\TicketRepositoryInterface;
use App\Models\Person;
use App\Models\Ticket;
use DateInterval;
use DateTime;
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
        $newTicket->due_date = $this->calculateDueDate(16, 9, 17, true);
        $ticket = $this->ticketRepository->create($newTicket);
        return (bool)$ticket;
    }

    /**
     * @throws Exception
     */
    function calculateDueDate($addtime, $dayStart, $dayEnd, $weekDaysOnly)
    {

        //Create required datetime objects and hours interval
        $datetime = new DateTime('now');
        $endofday = clone $datetime;
        $endofday->setTime($dayEnd, 00); //set end of working day time


        $interval = 'PT' . $addtime . 'H';

        //Add hours onto initial given date
        $datetime->add(new DateInterval($interval));

        //if initial date + hours is after the end of working day
        if ($datetime > $endofday) {
            //get the difference between the initial date + interval and the end of working day in seconds
            $seconds = $datetime->getTimestamp() - $endofday->getTimestamp();

            //Loop to next day
            while (true) {
                $endofday->add(new DateInterval('PT24H'));//Loop to next day by adding 24hrs
                $nextDay = $endofday->setTime($dayStart, 00);//Set day to working day start time
                //If the next day is on a weekend and the week day only param is true continue to add days
                if (in_array($nextDay->format('l'), array('Sunday', 'Saturday')) && $weekDaysOnly) {
                    continue;
                } else //If not a weekend
                {
                    $tmpDate = clone $nextDay;
                    $tmpDate->setTime($dayEnd, 00);//clone the next day and set time to working day end time
                    $nextDay->add(new DateInterval('PT' . $seconds . 'S')); //add the seconds onto the next day
                    //if the next day time is later than the end of the working day continue loop
                    if ($nextDay > $tmpDate) {
                        $seconds = $nextDay->getTimestamp() - $tmpDate->getTimestamp();
                        $endofday = clone $tmpDate;
                        $endofday->setTime($dayStart, 00);

                    } else //else return the new date.
                    {
                        return $endofday;
                    }
                }
            }
        }
        return $datetime;
    }
}
