<?php


namespace App\Controller;


use App\Entity\Libro;
use App\Form\ModificarLibroType;
use App\Repository\LibroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibroController extends AbstractController
{
    /**
     * @Route("/ap1", name="apartado1")
     */
    public function ap1(LibroRepository $libroRepository) : Response {
        $libros = $libroRepository->findOrdenadosTitulo();

        return $this->render('libros/listado.html.twig', [
            'libros' => $libros
        ]);
    }

    /**
     * @Route("/ap2", name="apartado2")
     */
    public function ap2(LibroRepository $libroRepository) : Response {
        $libros = $libroRepository->findOrdenadosAnioDescendente();

        return $this->render('libros/listado.html.twig', [
            'libros' => $libros
        ]);
    }

    /**
     * @Route("/ap3/{palabra}", name="apartado3")
     */
    public function ap3(LibroRepository $libroRepository, string $palabra) : Response {
        $libros = $libroRepository->findPorPalabraTitulo($palabra);

        return $this->render('libros/listado.html.twig', [
            'libros' => $libros
        ]);
    }

    /**
     * @Route("/ap4", name="apartado4")
     */
    public function ap4(LibroRepository $libroRepository) : Response {
        $libros = $libroRepository->findPorPalabraEditorial('a');

        return $this->render('libros/listado.html.twig', [
            'libros' => $libros
        ]);
    }

    /**
     * @Route("/ap5", name="apartado5")
     */
    public function ap5(LibroRepository $libroRepository) : Response {
        $libros = $libroRepository->findNoPrestados();

        return $this->render('libros/listado.html.twig', [
            'libros' => $libros
        ]);
    }

    /**
     * @Route("/ap6", name="apartado6")
     */
    public function ap6(LibroRepository $libroRepository) : Response {
        $libros = $libroRepository->findUnSoloAutor();

        return $this->render('libros/listado_con_autores.html.twig', [
            'libros' => $libros
        ]);
    }

    /**
     * @Route("/ap7", name="apartado7")
     */
    public function ap7(LibroRepository $libroRepository) : Response {
        $libros = $libroRepository->findOrdenadosTitulo();

        return $this->render('libros/listado_con_autores.html.twig', [
            'libros' => $libros
        ]);
    }

    /**
     * @Route("/ap8", name="apartado8")
     */
    public function ap8(LibroRepository $libroRepository) : Response {
        $libros = $libroRepository->findOrdenadosTitulo();

        return $this->render('libros/listado_enlace_autores.html.twig', [
            'libros' => $libros
        ]);
    }

    /**
     * @Route("/ap8/autores/{id}", name="apartado8_autores")
     */
    public function ap8Autores(Libro $libro) : Response {
        $autores = $libro->getAutores();

        return $this->render('autores/listado_por_libro.html.twig', [
            'libro' => $libro,
            'autores' => $autores
        ]);
    }

    /**
     * @Route("/libro/modificar/{id}", name="modificar_libro")
     */
    public function modificarLibro(Request $request, Libro $libro) : Response {
        $form = $this->createForm(ModificarLibroType::class, $libro);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('libros/modificar.html.twig', [
            'form' => $form->createView()
        ]);
    }
}