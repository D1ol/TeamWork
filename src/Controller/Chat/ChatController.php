<?php


namespace App\Controller\Chat;


use App\Core\AdvancedAbstractController;
use App\Form\Chat\ChatType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ChatController
 * @package App\Controller\Chat
 * @Route("/{_locale}", defaults={"_locale" = "en"}, requirements={"_locale" = "en|pl"})
 */
class ChatController extends AdvancedAbstractController
{
    /**
     * @Route("/chat", name="chat")
     */
    public function dashboard(Request $request)
    {
        $form = $this->createForm(ChatType::class);

        $form->handleRequest($request);
        return $this->render('chat/chat.html.twig', [
            'form' => $form->createView()
        ]);
    }
}