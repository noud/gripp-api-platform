<?php

declare(strict_types=1);

namespace App\Sonata\BlockBundle\Block\Service;

use App\Entity\Employee as User;
use App\Service\TimelineentryService;
use Sonata\AdminBundle\Admin\Pool;
use Sonata\AdminBundle\Templating\TemplateRegistry;
use Sonata\AdminBundle\Templating\TemplateRegistryInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

/**
 * @author Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
class TimelineBlockService extends AbstractBlockService
{
    /**
     * @var Pool
     */
    protected $pool;

    /**
     * @var TemplateRegistryInterface
     */
    private $templateRegistry;
    
    /**
     * @var TimelineentryService
     */
    private $timelineentryService;
    
    /**
     * @var Security
     */
    private $security;
    
    public function __construct(
        ?string $name,
        EngineInterface $templating,
        Pool $pool,
        TemplateRegistryInterface $templateRegistry = null,
        Security $security,
        TimelineentryService $timelineentryService
    ) {
        parent::__construct($name ?? '', $templating);

        $this->pool = $pool;
        $this->templateRegistry = $templateRegistry ?: new TemplateRegistry();
        $this->timelineentryService = $timelineentryService;
        $this->security = $security;
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $dashboardGroups = $this->pool->getDashboardGroups();

        $settings = $blockContext->getSettings();

        $visibleGroups = [];
        foreach ($dashboardGroups as $name => $dashboardGroup) {
            if (!$settings['groups'] || \in_array($name, $settings['groups'], true)) {
                $visibleGroups[] = $dashboardGroup;
            }
        }
        
        $user = $this->security->getToken()->getUser();
        $timelineentries = json_encode($this->timelineentryService->itemsForBlock($user));
        return $this->renderResponse($blockContext->getTemplate(), [
            'block' => $blockContext->getBlock(),
            'settings' => $settings,
            'timelineentries' => $timelineentries,
            'groups' => $visibleGroups,
        ], $response);
    }

    public function getName()
    {
        return 'Timeline';
    }

    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'template' => 'bundles/SonataBlockBundle/Block/timeline_block.html.twig',
            'groups' => false,
        ]);

        $resolver->setAllowedTypes('groups', ['bool', 'array']);
    }
}
