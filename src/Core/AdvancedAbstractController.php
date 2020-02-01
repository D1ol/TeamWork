<?php


namespace App\Core;


use App\Adapter\Clients\ReadModel\ClientsQuery;
use App\Adapter\Clients\Clients;
use App\Adapter\Projects\Projects;
use App\Adapter\Projects\ReadModel\ProjectsQuery;
use App\Adapter\Tasks\ReadModel\TasksQuery;
use App\Adapter\Tasks\Tasks;
use App\Adapter\Users\ReadModel\UsersQuery;
use App\Adapter\Users\Users;

use App\Entity\Clients\UseCase\CreateClient;
use App\Entity\Projects\UseCase\CreateProject;
use App\Entity\Tasks\UseCase\CreateTask;
use App\Entity\Tasks\UseCase\EditTask;
use App\Entity\Users\UseCase\ChangePhoto;
use App\Entity\Users\UseCase\CreateUser;
use App\Entity\Users\UseCase\EditUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdvancedAbstractController extends AbstractController
{
    public static function getSubscribedServices(): array
    {
        return array_merge(parent::getSubscribedServices(), [
            //nazwa serwisu który chcemy dodać do konstruktora
            'Users' => Users::class,
            'Clients' => Clients::class,
            'Projects' => Projects::class,
            'Tasks' => Tasks::class,
            'use_case.create_project' => CreateProject::class,
            'use_case.create_user' => CreateUser::class,
            'use_case.change_user_photo' => ChangePhoto::class,
            'use_case.edit_user' => EditUser::class,
            'use_case.create_client' => CreateClient::class,
            'use_case.create_task' => CreateTask::class,
            'use_case.edit_task' => EditTask::class,
            'read_model.clients_query' => ClientsQuery::class,
            'read_model.users_query' => UsersQuery::class,
            'read_model.projects_query' => ProjectsQuery::class,
            'read_model.tasks_query' => TasksQuery::class,
        ]);

    }
}