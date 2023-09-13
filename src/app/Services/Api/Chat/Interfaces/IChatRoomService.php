<?php

namespace App\Services\Api\Chat\Interfaces;


interface IChatRoomService
{
    public function createRoom();
    public function addParticipant();
    public function removeParticipant();
}
