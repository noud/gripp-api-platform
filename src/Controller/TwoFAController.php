<?php

namespace App\Controller;

use App\Repository\MedewerkerRepository as UserRepository;
use Endroid\QrCode\Factory\QrCodeFactory;
use Scheb\TwoFactorBundle\Model\Google\TwoFactorInterface;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Google\GoogleAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class TwoFAController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var GoogleAuthenticator
     */
    private $googleAuthenticator;

    /**
     * @var QrCodeFactory
     */
    private $qrCodeFactory;

    public function __construct(
        UserRepository $userRepository,
        GoogleAuthenticator $googleAuthenticator,
        QrCodeFactory $qrCodeFactory
    ) {
        $this->userRepository = $userRepository;
        $this->googleAuthenticator = $googleAuthenticator;
        $this->qrCodeFactory = $qrCodeFactory;
    }

    public function twoFactorAction()
    {
        $newkey = $this->googleAuthenticator->generateSecret();

        return new JsonResponse($newkey);
    }

    /**
     * @param int $id
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function qrAction($id)
    {
        /** @var TwoFactorInterface $user */
        $user = $this->userRepository->find($id);
        $qRContent = $this->googleAuthenticator->getQRContent($user);
        $qrCode = $this->qrCodeFactory->create($qRContent);
        $pngData = 'data:image/png;base64,'.base64_encode($qrCode->writeString());
        return new JsonResponse($pngData);
    }
}
