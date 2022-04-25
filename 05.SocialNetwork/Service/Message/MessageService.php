<?php


namespace Service\Message;

use Adapter\DatabaseInterface;
use Data\Message\MessagesViewData;
use Data\Message\Message;

class MessageService implements MessageServiceInterface
{
    private $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function send($fromId, $toId, $message)
    {
        $query = "INSERT INTO messages
                    SET 
                    sender_id = ?,
                    recipient_id = ?,
                    message = ?,
                    is_read = 0";

        $stmt = $this->db->prepare($query);
        $stmt->execute(
            [
                $fromId,
                $toId,
                $message
            ]
        );
    }

    public function getNewMessages($recipientId): MessagesViewData
    {
        $query = "SELECT
                    messages.id,
                    senders.id AS senderId,
                    senders.nickname,
                    messages.message
                FROM
                    messages
                INNER JOIN
                    people AS senders
                ON
                    senders.id = messages.sender_id
                WHERE
                    messages.recipient_id = ? AND
                    is_read = 0";
                    

        $stmt = $this->db->prepare($query);
        $stmt->execute([$recipientId]);

        $lazyLoadedMessages = function() use($stmt) {
            while ($message = $stmt->fetchObject(Message::class)) {
                yield $message;
            }
        };

        $messagesViewData = new MessagesViewData();
        $messagesViewData->setMessages($lazyLoadedMessages);

        return $messagesViewData;

    }

    public function getAllMessages($recipientId): MessagesViewData
    {
        $query = "SELECT
                    messages.id,
                    senders.id AS senderId,
                    senders.nickname,
                    messages.message
                FROM
                    messages
                INNER JOIN
                    people AS senders
                ON
                    senders.id = messages.sender_id
                WHERE
                    messages.recipient_id = ?";
                    

        $stmt = $this->db->prepare($query);
        $stmt->execute([$recipientId]);

        $lazyLoadedMessages = function() use($stmt) {
            while ($message = $stmt->fetchObject(Message::class)) {
                yield $message;
            }
        };

        $messagesViewData = new MessagesViewData();
        $messagesViewData->setMessages($lazyLoadedMessages);

        return $messagesViewData;
    }

    public function findOne($id, $recipientId): Message
    {
        $query = "SELECT
                    messages.id,
                    senders.id AS senderId,
                    senders.nickname,
                    messages.message
                FROM
                    messages
                INNER JOIN
                    people AS senders
                ON
                    senders.id = messages.sender_id
                WHERE
                    messages.id = ? AND
                    messages.recipient_id = ? AND
                    messages.is_read = 0 AND
                    messages.deleted_on IS NULL";

        $stmt = $this->db->prepare($query);
        $stmt->execute([$id, $recipientId]);

        $message = $stmt->fetchObject(Message::class);

        $stmt = $this->db->prepare("UPDATE messages
                            SET is_read = 1
                            WHERE id = ?");

        $stmt->execute([$id]);

        return $message;
    }
}

