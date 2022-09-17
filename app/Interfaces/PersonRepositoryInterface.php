<?php

namespace App\Interfaces;

use App\Models\Person;

interface PersonRepositoryInterface
{
    public function findById(int $id): Person|null;

    public function findByEmail(string $email): Person|null;

    public function create(Person $person): Person;

    public function update(int $id, array $person_details): Person;

    public function deleteById(int $id): bool;
}
