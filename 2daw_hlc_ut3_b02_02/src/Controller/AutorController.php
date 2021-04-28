<?php


namespace App\Controller;


use App\Entity\Autor;
use App\Entity\Libro;
use App\Form\AutorType;
use App\Form\ModificarLibroType;
use App\Repository\AutorRepository;
use App\Repository\LibroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AutorController extends AbstractController
{
    /**
     * @Route("/autores", name="autor_listado")
     */
    public function ap8Autores(AutorRepository $autorRepository) : Response {
        $autores = $autorRepository->findOrdenados();

        return $this->render('autores/listado.html.twig', [
            'autores' => $autores
        ]);
    }

    /**
     * @Route("/autores/nuevo", name="autor_nuevo")
     * @Route("/autores/modificar/{id}", name="autor_modificar")
     */
    public function modificar(Request $request, Autor $autor = null) : Response {
        $this->denyAccessUnlessGranted('ROLE_DOCENTE');
        if (null === $autor) {
            $autor = new Autor();
            $this->getDoctrine()->getManager()->persist($autor);
        }
        $form = $this->createForm(AutorType::class, $autor);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('autor_listado');
        }

        return $this->render('autores/modificar.html.twig', [
            'form' => $form->createView(),
            'autor' => $autor
        ]);
    }

    /**
     * @Route("/autores/eliminar/{id}", name="autor_eliminar")
     */
    public function eliminar(Request $request, Autor $autor) : Response {
        if ($request->request->has('confirmar')) {
            $this->getDoctrine()->getManager()->remove($autor);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('autor_listado');
        }

        return $this->render('autores/eliminar.html.twig', [
            'autor' => $autor
        ]);
    }
}