<?php

namespace App\Contracts\Menu;

interface MenuContracts
{
    public function getAll();
    public function createMenu(array $data);
    public function updateMenu(array $data);
    // public function login(array $data, $model);
    // public function logout($guard);
    // public function registration(array $data);
    // public function findEmailOrPhone(array $data);
    // public function otpSend(array $data);
    // public function findZoneById($uuid);
}