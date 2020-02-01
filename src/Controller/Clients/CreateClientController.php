<?php


namespace App\Controller\Clients;


use App\Adapter\Clients\UploadedFile;
use App\Core\AdvancedAbstractController;
use App\Entity\Clients\Client;
use App\Entity\Clients\UseCase\CreateClient;
use App\Entity\Clients\UseCase\CreateClient\Responder as CreateClientResponder;
use App\Form\Clients\AddClientType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateClientController extends AdvancedAbstractController implements CreateClientResponder
{
    /**
     * @Route("/clients/add", name="client_add", methods={"GET"})
     * @Route("/clients/create", name="client_create", methods={"POST"})
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(
            AddClientType::class,
            [],
            [
                'method' => 'POST',
                'action' => $this->generateUrl('client_create')
            ]
        );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $clientFile = $form->get('clientFile')->getData();

            $command = new CreateClient\Command(
                $data['name'],
                $data['color'],
                $clientFile ?
                    new UploadedFile($clientFile, $this->getParameter('client_file_dir')) :
                    null
            );
            $command->setResponder($this);

            $this->get('use_case.create_client')->execute($command);

            if ($this->container->get('session')->getFlashBag()->has('success'))
                return $this->redirectToRoute('clients_index');
        }

        return $this->render('clients/add.html.twig', [
            'form' => $form->createView()
        ]);

    }
    public function clientCreated(Client $client)
    {
        $this->addFlash('success', 'Client: '.$client->getName().' created');
    }

    public function clientExist(string $name)
    {
        // TODO: Implement clientExist() method.
    }
}