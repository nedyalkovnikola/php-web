<?php


namespace Data\Message;


class MessagesViewData
{
    /**
     * @var Message[]|\Generator
     */
    private $messages;

    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param callable $messages
     */
    public function setMessages(callable $messages)
    {
        $this->messages = $messages();
    }
}