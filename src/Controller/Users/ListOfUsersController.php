<?php


namespace App\Controller\Users;


use App\Adapter\Reports\ReadModel\ReportsQuery;
use App\Core\AdvancedAbstractController;


use App\Entity\Reports\UseCase\GenerateMonthReport;
use App\Form\Users\ChooseMonthType;
use DateTime;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ListOfUsersController
 * @package App\Controller\Users
 * @Route("/{_locale}", defaults={"_locale" = "en"}, requirements={"_locale" = "en|pl"})
 */
class ListOfUsersController extends AdvancedAbstractController
{
    /**
     * @Route("/users", name="users_index", methods={"GET|POST"})
     */
    public function indexAction(Request $request, GenerateMonthReport $generateMonthReport, ReportsQuery $reportsQuery)
    {
        $form = $this->createForm(ChooseMonthType::class);
        $form->handleRequest($request);




        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();


            $command = new GenerateMonthReport\Command(
                $data['user'],
                $data['month']
            );


            return $generateMonthReport->execute($command);


        }
        return $this->render('users/index.html.twig', [
            'form' => $form->createView(),
            'users' => $this->get('read_model.users_query')->getAll()
        ]);
    }


}