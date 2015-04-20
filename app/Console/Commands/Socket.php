<?php namespace App\Console\Commands;

use App\Services\Socket as SocketService;

use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Session\SessionProvider;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Socket extends Command
{
    protected $name = "socket:serve";

    protected $description = "Serve the socket server.";

    protected $socket;

    public function __construct(SocketService $socket)
    {
        parent::__construct();
        $this->socket = $socket;
    }

    public function fire()
    {
        $port = (integer) $this->option("port");

        if (!$port)
        {
            $port = 7778;
        }

        $sessionStore = $this->getLaravel()['session.store'];

        $session = new SessionProvider(
            $this->socket,
            $sessionStore
        );

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    $session->getHandler()
                )
            ),
            $port
        );

        $this->line("<info>Listening on port</info> <comment>" . $port . "</comment><info>.</info>");

        $server->run();
    }

    protected function getOptions()
    {
        return [
            ["port", null, InputOption::VALUE_REQUIRED, "Port to listen on.", null]
        ];
    }
}