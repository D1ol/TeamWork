<?php


namespace App\Controller\Clients;


use App\Core\AdvancedAbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ListOfClientsController
 * @package App\Controller\Clients
 * @Route("/{_locale}", defaults={"_locale" = "en"}, requirements={"_locale" = "en|pl"})
 */
class ListOfClientsController extends AdvancedAbstractController
{
    /**
     * @Route("/clients", name="clients_index", methods={"GET"})
     */
    public function indexAction()
    {
        return $this->render('clients/index.html.twig', [
            'clients' => $this->get('read_model.clients_query')->getAll()
        ]);
    }

}