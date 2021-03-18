<?php

namespace App\Controller;

use App\Entity\Solidaire;
use App\Form\SolidaireType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{


    /**
     * @Route("/{page}", name="home")
     */
    public function index($page = 'index', Request $request): Response
    {
        $solidaire = new Solidaire();
        $form = $this->createForm(SolidaireType::class, $solidaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($solidaire);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('home/' . seo($page) . '.html.twig', [
            'page' => $page,
            'form' => $form->createView()
        ]);
    }
}
//source
// https://stackoverflow.com/questions/14114411/remove-all-special-characters-from-a-string
function seo($string)
{
    return strtolower(
        preg_replace(
            array('#[\\s-]+#', '#[^A-Za-z0-9. -]+#'),
            array('-', ''),
            cleanString(
                urldecode($string)
            )
        )
    );
}

function cleanString($text)
{
    $utf8 = array(
        '/[áàâãªä]/u'   =>   'a',
        '/[ÁÀÂÃÄ]/u'    =>   'A',
        '/[ÍÌÎÏ]/u'     =>   'I',
        '/[íìîï]/u'     =>   'i',
        '/[éèêë]/u'     =>   'e',
        '/[ÉÈÊË]/u'     =>   'E',
        '/[óòôõºö]/u'   =>   'o',
        '/[ÓÒÔÕÖ]/u'    =>   'O',
        '/[úùûü]/u'     =>   'u',
        '/[ÚÙÛÜ]/u'     =>   'U',
        '/ç/'           =>   'c',
        '/Ç/'           =>   'C',
        '/ñ/'           =>   'n',
        '/Ñ/'           =>   'N',
        '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
        '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
        '/[“”«»„]/u'    =>   ' ', // Double quote
        '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
    );
    return preg_replace(array_keys($utf8), array_values($utf8), $text);
}
