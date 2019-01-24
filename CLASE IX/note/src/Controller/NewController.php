<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;


class NewController extends AbstractController {

    /**
     * @Route("/newresponse/{name}", name="new_response", requirements={"name"="[a-z]+"})
     */
    public function newResponse($name = null) {
        /*
          return $this->render('new/index.html.twig', [
          'controller_name' => 'NewController',
          ]); */

        return new Response("<html><body><h1>Hola $name desde OpenWebinars</h1></body></html>");
    }

    /**
     * @Route( {"en": "/new", "es": "/nuevo"} ,name="new")
     */
    public function index() {

        return $this->render('new/index.html.twig', [
                    'saludo' => "Hola desde OpenWebinars",
        ]);
    }

    /**
     * @Route("/new/{nota}", name="new_nota", requirements={"nota"="\d+"})
     */
    public function otherIndex($nota = null) {

        return $this->render('new/index.html.twig', [
                    'saludo' => "Hola desde OpenWebinars, este curso merece un $nota",
        ]);
    }

    /**
     * @Route("/new/{_locale}/{name}.{nota}.{_format}",
     * 
     * defaults={"nota":"10", "_format":"html"} ,
     * requirements={
     *      "locale":"en|es",
     *      "name":"david|izan",
     *      "nota":"\d+"
     *   }
     * ) 
     */
    public function anotherIndex($_locale = null, $name = null, $nota = null) {
        if ($_locale != null && $_locale == "en")
            $text = "Hi $name from OpenWebinars, this course deserves a $nota";
        else
            $text = "Hola $name desde OpenWebinars, este curso merece un $nota";

        return $this->render('new/index.html.twig', [
                    'saludo' => $text,
        ]);
    }

    
    
    
    /**
     * @Route("/url", name="new_url")
     */
    public function url( UrlGeneratorInterface $router) {

        $url = $this->generateUrl(
                'new_url'
        );

        $urlParametros = $this->generateUrl(
                'new_response', array('name' => 'david')
        );


        $urlQueryStrings = $router->generate('new_response', array(
            'name' => 'david',
            'nota' => 10,
        ));


        $urlLocalizada = $router->generate('new_nota', array(
            '_locale' => 'es',
        ));


        $urlAbsoluta = $this->generateUrl('new_response', array('name' => 'david'), UrlGeneratorInterface::ABSOLUTE_URL);


        return new Response("<html><body><ul>
                                <li>$url</li>    
                                    <li>$urlParametros</li>
                                        <li>$urlQueryStrings</li>
                                            <li>$urlLocalizada</li>
                                                <li>$urlAbsoluta</li>
                            </ul></body></html>");
    }
    
    
    
    
    
    /**
     * @Route("/redirect", name="new_redirect")
     */
    public function pageRedirect(){
    
          return $this->redirectToRoute('new_url');
        //  return $this->redirectToRoute('new_nota',array('nota'=>10));          
        //  return $this->redirect('http://www.google.com');
    }

}
