<?php

namespace App\Contracts\Items;

interface ItemContracts
{
    public function getAll();
    public function fidnById($id);
    public function createItem(array $data);
    public function updateItem(array $data);
    // public function updateCategory(array $data);
    // public function login(array $data, $model);
    // public function logout($guard);
    // public function registration(array $data);
    // public function findEmailOrPhone(array $data);
    // public function otpSend(array $data);
    // public function findZoneById($uuid);
}