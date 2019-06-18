<?php

namespace App\Service;

use App\Entity\Medewerker as User;
use App\Repository\TimelineentryRepository;
use KevinPapst\AdminLTEBundle\Helper\Constants;
use KevinPapst\AdminLTEBundle\Model\MessageModel;
use KevinPapst\AdminLTEBundle\Model\TaskModel;
use KevinPapst\AdminLTEBundle\Model\UserModel;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Cache\Simple\FilesystemCache;

class TimelineentryService
{
    /**
     * @var TimelineentryRepository
     */
    private $timelineentryRepository;

    public function __construct(
        TimelineentryRepository $timelineentryRepository
    ) {
        $this->timelineentryRepository = $timelineentryRepository;
    }
    
    /**
     * @return mixed|bool
     */
    public function findMessagesByUser(User $user)
    {
        return $this->timelineentryRepository->findMessagesByUserId($user);
    }
    
    public function messagesForSubscriber(User $user)
    {
        $userModel = new UserModel();
        
        $messages = $this->findMessagesByUser($user);
        $messagesForSubscriber = [];
        foreach ($messages as $message) {
            $username = trim($message['firstname'].' '.$message['infix']).' '.$message['lastname'];
            $userModel->setName($username);
            $messageForSubscriber = new MessageModel(
                $userModel,
                $message['message'],
                $message['date']
            );
            $messageForSubscriber
                ->setId($message['id']);
            $messagesForSubscriber[] = $messageForSubscriber;
        }
        return $messagesForSubscriber;
    }
    
    /**
     * @return mixed|bool
     */
    public function findTasksByUserId(int $userId)
    {
        return $this->timelineentryRepository->findTasksByUserId($userId);
    }
    
    public function tasksForSubscriber(int $userId)
    {
        $tasks = $this->findTasksByUserId($userId);
        $tasksForSubscriber = [];
        foreach ($tasks as $task) {
            $taskColor = 'blue';
            switch ($task['color']) {
                case '#00FF00':
                    $taskColor = Constants::COLOR_GREEN;
                    break;
                case '#FFFF00':
                    $taskColor = Constants::COLOR_YELLOW;
                    break;
                case '#FF0000':
                    $taskColor = Constants::COLOR_RED;
                    break;
            }
            $taskForSubscriber = new TaskModel();
            $taskForSubscriber
                ->setId($task['id'])
                ->setTitle($task['description'])
                ->setColor($taskColor)
                ->setProgress($task['name'])
            ;
            $tasksForSubscriber[] = $taskForSubscriber;
        }
        return $tasksForSubscriber;
    }
}
