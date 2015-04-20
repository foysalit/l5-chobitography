<?php namespace App\Services;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Socket implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $conn->Session->set('user', 'foysal');
        var_dump($conn->Session->all(), $conn->Session->getId());
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        if ($msg == 'sync.session'){
            var_dump('setting username');
            echo $from->Session->set('user', 'username');
        }


        var_dump($from->Session->getId(), $from->Session->all());
        $numRecv = count($this->clients) - 1;
        \Log::info(sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's'));

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        \Log::info("Connection {$conn->resourceId} has disconnected\n");
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        \Log::error("An error has occurred: {$e->getMessage()}\n");

        $conn->close();
    }
}