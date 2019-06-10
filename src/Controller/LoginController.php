<?php

namespace App\Controller;

use App\Form\Data\LoginData;
use App\Form\Type\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class LoginController extends AbstractController
{
    /**
     * @Route("/admin/login", name="admin_login")
     */
    public function loginAction(AuthenticationUtils $authenticationUtils): Response
    {
        $user = $this->getUser();

        if (null !== $user) {
            return $this->redirectToRoute('sonata_admin_dashboard');
        }

        $data = new LoginData();

        $form = $this->createForm(LoginType::class, $data);

        $error = $authenticationUtils->getLastAuthenticationError();

        if (null !== $error) {
            $this->addFlash(
                'error',
                $error->getMessage()
            );
        }

        return $this->render('security/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/logout", name="admin_logout")
     */
    public function logoutAction(): Response
    {
        return $this->redirectToRoute('admin_login');
    }
}
