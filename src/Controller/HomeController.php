<?php

namespace App\Controller;

use App\Lib\api as LibApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/{Id}', name: 'Home', defaults:[ 'Id' => 1 ])]
    public function index($Id): Response
    {
        settype($Id, 'integer');
        if (!is_int($Id)) {
            return $this->redirectToRoute('Home');
        }
        $Api = new LibApi();
        $Charaters = $Api->getCharacters($Id);
         if (isset($Charaters['Error'])) {
            return $this->redirectToRoute('Home');
        }
        $Episodes = $Api->getEpisodes();
        $Data = $Api->getData($Charaters,$Episodes);
        $IdDown = $Id - 1;
        $IdUp = $Id + 1;
        return $this->render('home.html.twig', ['Data' => $Data, 'Id' => $Id, 'IdDown' => $IdDown, 'IdUp' => $IdUp]);
    }
}
