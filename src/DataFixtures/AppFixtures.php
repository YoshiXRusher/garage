<?php

namespace App\DataFixtures;

use App\Entity\Marque;
use App\Entity\Modele;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $jsonobj = file_get_contents($filname = "public/resource/listetest.json");
        $liste = json_decode($jsonobj, true);
        $tabMarque = [];

        foreach($liste as $name){
            $marque = new Marque();
            foreach ($name["marque"] as $iMarque) {
                $marquejson = $iMarque["name"];
                $date = $iMarque["dateCreation"];
                $logo = $iMarque["logo"];
                $slogan = $iMarque["slogan"];
                $marque->setName($marquejson)
                        ->setLogo($logo)
                        ->setCreatedAt($date)
                        ->setSlogan($slogan);
                $manager->persist($marque);
            }
            foreach ($name["modeles"] as $modele) {
                    $modele = new Modele();
                    $models = $modele["model"];
                    $year = $modele["annee"];
                    $modele->setName($models)
                            ->setCreateAt($year)
                            ->setMarque($marque);
                    $manager->persist($modele);
                    $tabModel[] = $modele;
                }
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
