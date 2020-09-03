<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Word;

class WordController extends AbstractController
{
    /**
     * @Route("/word", name="word")
     */
    public function index()
    {
        return $this->render('word/word.html.twig', [
            'countRecords' => count($this->getDoctrine()
            ->getRepository(Word::class)->findAll()),
            
        ]);
    }
}
