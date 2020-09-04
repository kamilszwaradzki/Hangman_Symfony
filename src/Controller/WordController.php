<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Word;
use Symfony\Component\HttpFoundation\Response;

/**
* @Route("/word", name="word")
*/

class WordController extends AbstractController
{
    /**
     * @Route("/", name="word_index", methods={"GET"})
     */
    public function index()
    {
        return $this->render('word/word.html.twig', [
            'countRecords' => $this->getDoctrine()
            ->getRepository(Word::class)->count([]),
            
        ]);
    }
    /**
     * @Route("/{id}", name="modified_word")
     */
    public function getModifiedRecord($id)
    {
        $letters = $this->getDoctrine()
        ->getRepository(Word::class)
        ->find($id);
        if(isset($letters)){
            $letters=$letters->getLetters();
            foreach ($letters as &$value) {
                $value = '_';
            }
            return $this->json($letters);
        }
        else{
            return new Response(
                '<html><body> no id in database</body></html>'
            ); 
        }
        
    }
    /**
     * @Route("/{id}/{letter}", name="selected_letters_in_word")
     */
    public function isWordContainSelectedLetter($id,$letter)
    {
        // if char array contains letter if yes return indexes  
        // else return -1
        $letters = $this->getDoctrine()
        ->getRepository(Word::class)
        ->find($id);
        if(isset($letters) && count(str_split($letter)) === 1){
            $letters = $letters->getLetters();
            $letter = mb_strtolower($letter,'UTF-8');
            $keys = array_filter($letters, function($element) use($letter){
                return isset($element) && $element == $letter;
              });
              return $this->json(array_keys($keys));
        }
        else if(isset($letters) && $letter === 'show')
        {
            $letters = $this->getDoctrine()
            ->getRepository(Word::class)
            ->find($id)->getLetters();
            return $this->json(strtoupper(implode($letters)));
        }
        else{
            return $this->json([]);
        }
    }
}
