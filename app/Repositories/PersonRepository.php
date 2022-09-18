<?php

namespace App\Repositories;

use App\Interfaces\PersonRepositoryInterface;
use App\Models\Person;
use Exception;

class PersonRepository implements PersonRepositoryInterface
{

    public function __construct(private Person $model)
    {
    }

    public function findById(int $id): Person|null
    {
        return $this->model->find($id);
    }

    public function findByEmail(string $email): Person|null
    {
        return $this->model->where('email', $email)->first();
    }

    public function create(Person $person): Person
    {
        $person->save();
        return $person;
    }

    /**
     * @throws Exception
     */
    public function update(int $id, array $person_details): Person
    {
        $actualPerson = $this->findById($id);
        if (!$actualPerson) {
            throw new Exception('Person not found by id');
        }
        $actualPerson->update($person_details);

        return $actualPerson;
    }

    /**
     * @throws Exception
     */
    public function deleteById(int $id): bool
    {
        $actualPerson = $this->findById($id);
        if (!$actualPerson) {
            throw new Exception('Person not found by id');
        }

        return $actualPerson->delete();
    }
}
