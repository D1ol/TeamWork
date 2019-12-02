<?php

namespace App\Controller\Users;

use App\Adapter\Users\UploadedPhoto;
use App\Core\AdvancedAbstractController;
use App\Entity\Users\UseCase\ChangePhoto;
use App\Entity\Users\UseCase\CreateUser;
use App\Entity\Users\UseCase\CreateUser\Responder as CreateUserResponder;
use App\Entity\Users\UseCase\EditUser;
use App\Entity\Users\User;
use App\Form\Users\AddEditUserType;
use App\Form\Users\AddUserType;
use App\Form\Users\AddUserPhotoType;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users\UseCase\EditUser\Responder as EditResponder;
use App\Entity\Users\UseCase\ChangePhoto\Responder as ChangePhotoResponder;

class ShowUserController extends AdvancedAbstractController implements EditResponder, ChangePhotoResponder
{
    /**
     * @Route("/users/{userID}", name="user_show", methods={"GET|POST"})
     */
    public function showAction($userID, Request $request)
    {
        $formData = $this->getUserFromObjectToArray($this->get('Users')->findOneById($userID));

        $form = $this->createForm(AddEditUserType::class, $formData);
        $formPhoto = $this->createForm(AddUserPhotoType::class);

        $form->handleRequest($request);
        $formPhoto->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $command = new EditUser\Command(
                $userID,
                $data['name'],
                $data['surname'],
                $data['email'],
                $data['phone']
            );
            $command->setResponder($this);

            $editUser = $this->get('use_case.edit_user');
            $editUser->execute($command);
            return $this->redirectToRoute('user_show', ['userID'=>$userID]);
        }

        if ($formPhoto->isSubmitted() && $formPhoto->isValid()) {
            $userFile = $formPhoto->get('userFile')->getData();
            $command = new ChangePhoto\Command(
                $userID,
                $userFile ?
                    new UploadedPhoto($userFile,  $this->getParameter('user_file_dir')) :
                    null
            );
            $command->setResponder($this);


            $changePhoto = $this->get('use_case.change_user_photo');
            $changePhoto->execute($command);

            return $this->redirectToRoute('user_show', ['userID'=>$userID]);
        }

        return $this->render('users/show.html.twig', [
            'user' => $this->get('read_model.users_query')->getById($userID),
            'form' => $form->createView(),
            'formPhoto' => $formPhoto->createView()
        ]);
    }

    public function getUserFromObjectToArray(User $user){
        return [
            'name'=>$user->getName(),
            'surname'=>$user->getSurname(),
            'email'=>$user->getEmail(),
            'phone'=>$user->getPhone()
        ];

    }

    public function userEdited(User $user)
    {
        $this->addFlash('success', 'User: '.$user->getName().' '.$user->getSurname().' updated');
    }

    public function photoChanged()
    {
        // TODO: Implement photoChanged() method.
    }
}