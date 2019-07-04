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
use App\Entity\Contactpersoon;

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
    
    public function findCompaniesByContact(Contactpersoon $contactpersoon): ?array
    {
        return $this->timelineentryRepository->findCompaniesByContact($contactpersoon);
    }
    
    public function findMessagesByUser(User $user): ?array
    {
        return $this->timelineentryRepository->findMessagesByUserId($user);
    }
    
    public function itemsForBlock(User $user)
    {
        $messages = $this->findMessagesByUser($user);
        $messagesForBlock = [];
        foreach ($messages as $message) {
            $username = trim($message['firstname'].' '.$message['infix']).' '.$message['lastname'];
            $messagesForBlock[] = [
                'id' => $message['id'],
                'title' => 'Bericht van'.' '.$username,
                'content' => $message['message'],
                'start' => $message['date']->format('Y-m-d'),
                'style' => "color: black; background-color: #00a65a;"
            ];
        }
        
        $tasks = $this->findTasksByUserId($user);
        $tasksForBlock = [];
        foreach ($tasks as $task) {
            $tasksForBlock[] = [
                'id' => $task['id'],
                'content' => $task['description'].' ('.$task['name'].'%)',
                'start' => $task['date']->format('Y-m-d'),
                'style' => "color: black; background-color: #dd4b39;"
            ];
        }
        
        $itemsForBlock = array_merge($messagesForBlock, $tasksForBlock);
        return $itemsForBlock;
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
    
    public function findTasksByUserId(User $user): ?array
    {
        return $this->timelineentryRepository->findTasksByUserId($user);
    }
    
    public function tasksForSubscriber(User $user)
    {
        $tasks = $this->findTasksByUserId($user);
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
