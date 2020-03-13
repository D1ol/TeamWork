<?php

namespace App\Controller\Users;

use App\Core\AdvancedAbstractController;
use App\Entity\Users\UseCase\CreateUser;
use App\Entity\Users\UseCase\CreateUser\Responder as CreateUserResponder;
use App\Entity\Users\User;
use App\Form\Users\AddUserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CreateUserController
 * @package App\Controller\Users
 * @Route("/{_locale}", defaults={"_locale" = "en"}, requirements={"_locale" = "en|pl"})
 */
class CreateUserController extends AdvancedAbstractController implements CreateUserResponder
{

    /**
     * @Route("/users/add", name="user_add", methods={"GET"})
     * @Route("/users/create", name="user_create", methods={"POST"})
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(
            AddUserType::class,
            [],
            [
                'method' => 'POST',
                'action' => $this->generateUrl('user_create')
            ]
        );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $command = new CreateUser\Command(
                $data['name'],
                $data['surname'],
                $data['email'],
                $data['phone'],
                $data['password']
            );
            $command->setResponder($this);

             $this->get('use_case.create_user')->execute($command);

            if ($this->container->get('session')->getFlashBag()->has('success'))
                return $this->redirectToRoute('users_index');
        }

        return $this->render('users/add.html.twig', [
            'form' => $form->createView()
        ]);

    }
    public function userCreated(User $user)
    {
        $this->addFlash('success', 'Użytkownik został stworzony');
    }

    public function providedEmailIsInUse(string $email)
    {
        $this->addFlash('error', 'Użytkownik o adresie '.$email.' już istnieje');
    }
}