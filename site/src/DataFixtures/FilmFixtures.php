<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Film;

class FilmFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    { //LOAD RANDOM INFO
        for($i = 1; $i <=10; $i++){
            $film = new Film();
            $film   ->setNumber($i)
                    ->setTitle("titre n°$i")
                    ->setTheme("Theme 10$i")
                    ->setActor("actor $i")
                    ->setYear(190+$i)
                    ->setProp("AP")
                    ->setDuration($i*20)
                    ->setInfo("XX $i XX");

            $manager->persist($film);
        }

        $manager->flush();
    }
}
