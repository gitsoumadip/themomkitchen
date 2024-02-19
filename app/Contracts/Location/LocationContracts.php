<?php

namespace App\Contracts\Location;

interface LocationContracts
{
    public function getAll();
    public function createType(array $data);
    // public function updateCategory(array $data);
    // public function login(array $data, $model);
    // public function logout($guard);
    // public function registration(array $data);
    // public function findEmailOrPhone(array $data);
    // public function otpSend(array $data);
    // public function findZoneById($uuid);
}
