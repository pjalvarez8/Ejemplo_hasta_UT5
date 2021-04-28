<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SeguridadController extends AbstractController
{
    /**
     * @Route("/entrar", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils) : Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $ultimoUsuario = $authenticationUtils->getLastUsername();
        return $this->render('seguridad/login.html.twig', [
            'error' => $error,
            'ultimo_usuario' => $ultimoUsuario
        ]);
    }
    /**
     * @Route("/salir", name="logout")
     */
    public function logout()
    {
    }
}