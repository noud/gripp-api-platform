<?php

/*
 * This file is part of the AdminLTE-Bundle demo.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\EventSubscriber;

use App\Service\TimelineentryService;
use KevinPapst\AdminLTEBundle\Event\TaskListEvent;
use KevinPapst\AdminLTEBundle\Event\ThemeEvents;
use KevinPapst\AdminLTEBundle\Helper\Constants;
use KevinPapst\AdminLTEBundle\Model\TaskModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Class TaskSubscriber adds user task to the top bar.
 */
class TaskSubscriber implements EventSubscriberInterface
{
    /**
     * @var Security
     */
    protected $security;

    /**
     * @var TimelineentryService
     */
    protected $timelineentryService;
    
    /**
     * @param Security $security
     */
    public function __construct(
        Security $security,
        TimelineentryService $timelineentryService
    ) {
        $this->security = $security;
        $this->timelineentryService = $timelineentryService;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ThemeEvents::THEME_TASKS => ['onTasks', 100],
        ];
    }

    /**
     * @param TaskListEvent $event
     */
    public function onTasks(TaskListEvent $event)
    {
        $user = $this->security->getToken()->getUser();
        $tasks = $this->timelineentryService->tasksForSubscriber($user);
        foreach ($tasks as $task) {
            $event->addTask($task);
        }
    }
}
