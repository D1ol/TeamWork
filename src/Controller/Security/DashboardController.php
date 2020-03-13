<?php


namespace App\Controller\Security;


use App\Adapter\Clients\Clients;
use App\Adapter\Projects\Projects;
use App\Adapter\Tasks\Tasks;
use App\Adapter\Users\Users;
use App\Core\AdvancedAbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller\Security
 * @Route("/{_locale}", defaults={"_locale" = "en"}, requirements={"_locale" = "en|pl"})
 */
class DashboardController extends AdvancedAbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function dashboard(Tasks $tasks, Clients $clients, Projects $projects, Users $users)
    {
        return $this->render('security/dashboard.html.twig', [
            'params' => [
                'tasks' => count($tasks->findCountTasksToday()),
                'clients' => count($clients->findAll()),
                'projects' => count($projects->findAll()),
                'users' => count($users->findAll()),
            ]
        ]);
    }

}