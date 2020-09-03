<?php

namespace App\DataFixtures;

use App\Entity\Word;
use Symfony\Component\Finder\SplFileInfo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        //load file to variable
        $file = new SplFileInfo(__DIR__.'/../../var/words_alpha.txt', '', '');
        $content = $file->getContents();
        $arr_content = preg_split('/[\s\n]+/',$content);
        shuffle($arr_content);

        for($i = 0; $i < 20000; $i++)
        {
            $word = new Word();
            $word->setLetters(str_split($arr_content[$i]));
            $manager->persist($word);
        }
        $manager->flush();
    }
}
