<?php

namespace App\Controller\Api;

use App\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/** 
 * @Route("/api/v1", name="api_usuario_")
 */
class UsuarioController extends AbstractController
{
    /**
     * @Route("/lista", methods={"GET"}, name="lista")
     */
    public function lista(): JsonResponse
    {
        $doctrine = $this->getDoctrine()->getRepository(Usuario::class);

        return new JsonResponse([$doctrine->pegarTodos()]);
    }

    /**
     * @Route("/cadastra", methods={"POST"}, name="cadastra")
     */
    public function cadastrar(Request $request): Response
    {
        $data = $request->request->all();

        $usuario = new Usuario;
        $usuario->setNome($data['nome']);
        $usuario->setEmail($data['email']);

        // dump($usuario);

        $doctrine = $this->getDoctrine()->getManager();
        $doctrine->persist($usuario);
        $doctrine->flush();

        // dump($usuario);

        if( $doctrine->contains($usuario) ){
            return new Response("ok", 200);
        } else {
            return new Response("erro", 400);
        }
    }
}