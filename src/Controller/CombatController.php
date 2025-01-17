<?php
namespace App\Controller;

use App\Entity\Combat;
use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CombatController extends AbstractController
{
    #[Route('/liste', name: 'pokemon_list')]
    public function listePokemons(PokemonRepository $pokemonRepository): Response
    {
        $pokemons = $pokemonRepository->findAll();
        return $this->render('combat/liste.html.twig', ['pokemons' => $pokemons]);
    }
#[Route('/combat', name: 'start_combat', methods: ['POST'])]
    public function lancerCombat(Request $request, PokemonRepository $pokemonRepository, EntityManagerInterface $em): Response
    {
        $pokemon1 = $pokemonRepository->find($request->request->get('pokemon1'));
        $pokemon2 = $pokemonRepository->find($request->request->get('pokemon2'));

        if (!$pokemon1 || !$pokemon2) {
            throw $this->createNotFoundException('Pokémon non trouvé');
        }

        $combat = new Combat();
        $combat->setPokemon1($pokemon1);
        $combat->setPokemon2($pokemon2);

        $resultat = [];
        while ($pokemon1->getPointsVie() > 0 && $pokemon2->getPointsVie() > 0) {
            $this->attaque($pokemon1, $pokemon2, $resultat);
            $this->attaque($pokemon2, $pokemon1, $resultat);
            $combat->setNbrTours($combat->getNbrTours() + 1);
        }

        $vainqueur = $pokemon1->getPointsVie() > 0 ? $pokemon1 : $pokemon2;

        $em->persist($combat);
        $em->flush();

        return $this->render('combat/resultat.html.twig', ['resultat' => $resultat, 'vainqueur' => $vainqueur]);
    }

    private function attaque(Pokemon $attaquant, Pokemon $defenseur, array &$resultat): void
    {
        $degats = $attaquant->getPointsAttaque() - $defenseur->getPointsDefense();
        if ($degats > 0) {
            $defenseur->setPointsVie($defenseur->getPointsVie() - $degats);
        }
        $resultat[] = "{$attaquant->getNom()} attaque {$defenseur->getNom()}, {$defenseur->getNom()} a {$defenseur->getPointsVie()} points de vie restants.";
    }
}