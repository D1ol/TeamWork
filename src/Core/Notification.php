<?php


namespace App\Core;


use App\Entity\Users\User;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class Notification extends AdvancedAbstractController implements MessageComponentInterface
{
    protected $clients;
    protected $connections = array();
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->clients = new \SplObjectStorage;
    }

    /**
     * A new websocket connection
     *
     * @param ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $conn->send(json_encode('Connected'));

    }


    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg);

        switch ($data->type) {
            case 'chat':
                /** @var User $user */
                $user = $this->container->get('doctrine')->getManager()->getRepository(User::class)->findOneBy(['id' => $data->user_id]);
                $userPhoto = $user->getPhoto()?"/uploads/avatar/".$user->getName()."/".$user->getPhoto():"/uploads/avatar/default.jpg";
                if (!$user) {
                    $from->close();
                }
                $chatMessage = $data->chat_msg;
                $dateTimeNow = (new \DateTime('now'))->format('H:i');
                $response_from =
                    '<div class="d-flex justify-content-end mb-4">     
                                <div class="msg_cotainer_send">'
                                . $chatMessage .
                                    '<span class="msg_time_send">'.$dateTimeNow.'</span>
                                </div>
                                 <div class="img_cont_msg">
									<img src='.$userPhoto.' class="rounded-circle user_img_msg">
								</div>
                    </div>';

                $response_to =
                    '<div class="d-flex justify-content-start mb-4">
                                <div class="img_cont_msg">
									<img src='.$userPhoto.' class="rounded-circle user_img_msg">
								</div>
                                <div class="msg_cotainer">'
                                    . $chatMessage .
                                    '<span class="msg_time">'.$dateTimeNow.'</span>
                                </div>
                    </div>';

                // Output
                $from->send(json_encode(array("type" => $data->type, "msg" => $response_from)));
                foreach ($this->clients as $client) {
                    if ($from != $client) {
                        $client->send(json_encode(array("type" => $data->type, "msg" => $response_to)));
                    }
                }
                break;
        }

    }

    /**
     * A connection is closed
     * @param ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn)
    {
        foreach ($this->connections as $key => $conn_element) {
            if ($conn === $conn_element) {
                unset($this->connections[$key]);
                break;
            }
        }
    }

    /**
     * Error handling
     *
     * @param ConnectionInterface $conn
     * @param \Exception $e
     */
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->send("Error : " . $e->getMessage());
        $conn->close();
    }


}