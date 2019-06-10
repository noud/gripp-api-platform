<?php

namespace App\Security;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Exception\LockedException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Guard\AuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects) (15)
 */
class LoginFormAuthenticator extends AbstractFormLoginAuthenticator implements AuthenticatorInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var CsrfTokenManagerInterface
     */
    private $csrfTokenManager;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        UserPasswordEncoderInterface $passwordEncoder,
        CsrfTokenManagerInterface $csrfTokenManager,
        TranslatorInterface $translator
    ) {
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->translator = $translator;
    }

    public function supports(Request $request): bool
    {
        return 'sonata_login' === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request): array
    {
        $credentials = [
            'username' => $request->request->get('login')['username'],
            'password' => $request->request->get('login')['password'],
        ];
        if (isset($request->request->get('login')['_token'])) {
            $credentials[] = ['csrf_token' => $request->request->get('login')['_token']];
        }

        if (null !== $request->getSession()) {
            $request->getSession()->set(
                Security::LAST_USERNAME,
                $credentials['username']
            );
        }

        return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider): UserInterface
    {
        if (isset($credentials['csrf_token'])) {
            $token = new CsrfToken('authenticate', $credentials['csrf_token']);

            if (!$this->csrfTokenManager->isTokenValid($token)) {
                throw new InvalidCsrfTokenException($this->translator->trans('login.messages.token_invalid', [], 'login'));
            }
        }

        try {
            return $userProvider->loadUserByUsername($credentials['username']);
        } catch (\Exception $e) {
            throw new CustomUserMessageAuthenticationException($this->translator->trans('login.messages.user_not_found', [], 'login'));
        }
    }

    public function checkCredentials($credentials, UserInterface $user): bool
    {
        if (!$this->passwordEncoder->isPasswordValid($user, $credentials['password'])) {
            throw new CustomUserMessageAuthenticationException($this->translator->trans('login.messages.data_invalid', [], 'login'));
        }

        return true;
    }

    protected function getLoginUrl(): string
    {
        return $this->router->generate('sonata_login');
    }

    /**
     * {@inheritdoc}
     *
     * @param string $providerKey
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey): RedirectResponse
    {
        return new RedirectResponse($this->router->generate('sonata_admin_dashboard'));
    }
}
