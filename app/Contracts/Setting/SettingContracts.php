<?php

namespace App\Contracts\Setting;

interface SettingContracts
{
    public function getAll();
    public function updateSetting(array $data); 
    public function createSetting(array $data);
    // public function login(array $data, $model);
    // public function logout($guard);
    // public function registration(array $data);
    // public function findEmailOrPhone(array $data);
    // public function otpSend(array $data);
    // public function findZoneById($uuid);
}
