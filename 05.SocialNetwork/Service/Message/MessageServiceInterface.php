<?php


namespace Service\Message;

use Data\Message\Message;
use \Data\Message\MessagesViewData;

interface MessageServiceInterface
{
    public function send($fromId, $toId, $message);

    public function getNewMessages($recipientId): MessagesViewData;

    public function findOne($id, $recipientId): Message;

    public function getAllMessages($recipientId): MessagesViewData;
}