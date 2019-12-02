<?php

namespace App\Controller\Users;

use App\Core\AdvancedAbstractController;
use App\Entity\Users\UseCase\CreateUser;
use App\Entity\Users\UseCase\CreateUser\Responder as CreateUserResponder;
use App\Entity\Users\User;
use App\Form\Users\AddUserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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

            $createUser = $this->get('use_case.create_user');
            $createUser->execute($command);

            return $this->redirectToRoute('user_add');
        }



        return $this->render('users/add.html.twig', [
            'form' => $form->createView()
        ]);

    }
    public function userCreated(User $user)
    {
        // TODO: Implement userCreated() method.
    }

    public function providedEmailIsInUse(string $email)
    {
        // TODO: Implement providedEmailIsInUse() method.
    }
}