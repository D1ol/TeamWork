<?php


namespace App\Controller\Users;


use App\Core\AdvancedAbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ListOfUsersController extends AdvancedAbstractController
{
    /**
     * @Route("/users", name="users_index", methods={"GET"})
     */
    public function indexAction()
    {
        return $this->render('users/index.html.twig', [
            'users' => $this->get('read_model.users_query')->getAll()
        ]);
    }

}