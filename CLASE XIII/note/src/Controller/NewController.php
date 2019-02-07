<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Session\SessionInterface;




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
    
    
    
    /**
     * @Route("/error", name="new_error")
     */
    public function error(){
                 $res = 1/0;
                 
                 return new Response($res);
    }

    
    
    
    /**
     * @Route("/request", name="new_request")
     */
    public function testRequest(Request $request){
        
        //http://localhost:8000/request?v1=hola&v2=que%20tal
        $v1 = $request->get('v1');
        $v2 = $request->get('v2');
        $user = $request->cookies->get('user');
               
        
        $response = new Response();
        
        if(is_null($user)){
            $response->headers->setCookie(new Cookie('user', 'david'));
        }

        $response->setContent($v1." ".$v2." ".$user);

        return $response;
    }


    
    /**
     * @Route("/json", name="new_json")
     */
    public function testJson(){
        
 //       $response = new JsonResponse(['data' => 123]);
        $response = JsonResponse::fromJsonString('{ "data": 123 }');

        return $response;

    }    
    
    
    

    /**
     * @Route("/file", name="new_file")
     */
    public function testFile(){    
        
        $file = new File('Symfony_best_practices_4.2.pdf');
        //return $this->file($file);
        return $this->file($file, 'my_file.pdf', ResponseHeaderBag::DISPOSITION_INLINE);

            
    }    
    
    
    
    /**
     * @Route("/fileattached", name="new_file_attached")
     */
    public function testFileAttached(){    
        $fileContent = "hola hola"; // the generated file content
        $response = new Response($fileContent);

        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
            'hola.txt'
        );

      
        $response->headers->set('Content-Disposition', $disposition);
        
        return $response;
    }
    
    
    
    /**
     * @Route("/session", name="new_session")
     */
    public function testSession(SessionInterface $session){    
        
        if(is_null($session->get('name'))){
            $session->set('name', 'david');
        }
        
       
        return new Response("Valor guardado en sesión");
    }    
    
    
    

    /**
     * @Route("/sessionname", name="new_session_name")
     */
    public function testSessionName(SessionInterface $session){    
        
        $name = $session->get('name');
       
        return new Response("Hola ".$name);
    }      
    
    
    /**
     * @Route("/flash", name="new_flash")
     */
    public function testFlash(){    
        
          $this->addFlash(
            'notice',
            'Mensaje notificación'
          );
          
          $this->addFlash(
            'warning',
            'Mensaje advertencia'
          );

          $this->addFlash(
            'error',
            'Mensaje error'
          );      
          
        return $this->render('new/flash.html.twig');          
          
    }    
    


    /**
     * @Route("/course/index", name="new_threelevel")
     */
    public function testThreeLevel(){    
        
        $cursos = array('Symfony 4', 'Seguridad Web', 'DevOps');        
          
        return $this->render('new/course.index.html.twig',['cursos'=> $cursos]);          
          
    }

    
    

    /**
     * @Route("/course/index/include", name="new_threelevel_include")
     */
    public function testThreeLevelInclude(){    
        
        $cursos = array('Symfony 4', 'Seguridad Web', 'DevOps');        
          
        return $this->render('new/course.index_include.html.twig',['cursos'=> $cursos]);          
          
    }    



/**
     * @Route("/course/index/embed", name="new_threelevel_embed")
     */
    public function testThreeLevelEmbed(){    
        
        $cursos = array(1, 2, 3);        
          
        return $this->render('new/course.index_embed.html.twig',['cursos'=> $cursos]);          
          
    }    


    
    /**
     * @Route("/course/item/{id}", name="new_item")
     */
    public function courseItem($id){    
        
        $cursos = array(1=>'Symfony 4', 2=>'Seguridad Web', 3=>'DevOps');        
          
        return $this->render('new/course.item.html.twig',['curso'=> $cursos[$id]]);          
          
    }    
    
}
