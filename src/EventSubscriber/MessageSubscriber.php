<?php

/*
 * This file is part of the AdminLTE-Bundle demo.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\EventSubscriber;

use App\Service\TimelineentryService;
use KevinPapst\AdminLTEBundle\Event\MessageListEvent;
use KevinPapst\AdminLTEBundle\Event\ThemeEvents;
use KevinPapst\AdminLTEBundle\Model\MessageModel;
use KevinPapst\AdminLTEBundle\Model\UserModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Class MessageSubscriber adds user messages to the top bar.
 */
class MessageSubscriber implements EventSubscriberInterface
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
            ThemeEvents::THEME_MESSAGES => ['onMessages', 100],
        ];
    }

    /**
     * @param MessageListEvent $event
     */
    public function onMessages(MessageListEvent $event)
    {
        $user = $this->security->getToken()->getUser();
        $messages = $this->timelineentryService->messagesForSubscriber($user);
        foreach ($messages as $message) {
            $event->addMessage($message);
        }
    }
}
