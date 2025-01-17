<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\Pokemon;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $client= HttpClient ::create();
        $response= $client->request ('GET','https://pokebuildapi.fr/api/v1/pokemon');
        $pokemons = $response ->toArray();
        //dd($pokemons);
        
        for ($i=0; $i < count($pokemons); $i++) { 
            $pokemon = new Pokemon();
            $pokemon->setNom($pokemons[$i]["name"]);
            $pokemon->setPointsVie($pokemons[$i]["stats"]["HP"]);
            $pokemon->setPointsAttaque($pokemons[$i]["stats"] ["attack"]);
            $pokemon->setPointsDefense($pokemons[$i]["stats"]["defense"]);
            $pokemon->setImage($pokemons[$i]["image"]);
            $manager->persist($pokemon);
            
        }
       
        
        $manager->flush();
    }
}
