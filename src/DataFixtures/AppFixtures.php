<?php

namespace App\DataFixtures;

use App\Entity\Users;
use App\Entity\Marque;
use App\Entity\Modele;
use Monolog\DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // création d'un admin 
        $admin = new Users();
        $admin->setLastName('gallais')
            ->setFirstName('michel')
            ->setAddress('chaussée d\'aelbeke')
            ->setZipcode('7700')
            ->setCity('Mouscron')
            ->setCreatedAt(new DateTimeImmutable())
            ->setEmail('michel@gmail.com')
            ->setPassword($this->passwordHasher->hashPassword($admin,'password'))
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $jsonobj = file_get_contents($filname = "public/resource/listeVoiture.json");
        $arr = json_decode($jsonobj, true);
        $tabMarque = [];

       foreach ($arr as $tab) {
            $marques = $tab["marque"];
            $modeles = $tab["modeles"];
            foreach ($marques as $marqueInfo) {
                $marqueName = $marqueInfo["name"];
                $marqueLogo = $marqueInfo["logo"];
                $marqueDate = $marqueInfo["dateCreation"];
                $marqueSlogan = $marqueInfo["slogan"];
                $sloganInconnu = "Cette marque n'a pas de slogan ou il est inconnu";
                if ($marqueSlogan == null) {
                    $marqueSlogan = $sloganInconnu;
                }
                $marque = new Marque();
                $marque->setName($marqueName)
                       ->setLogo($marqueLogo)
                       ->setSlogan($marqueSlogan )
                       ->setCreatedAt($marqueDate);
                
                foreach ($modeles as $modeleInfo) {
                    $modelName = $modeleInfo["model"];
                    $marqueAnnee = $modeleInfo["annee"];
                    $modele = new Modele();
                    $modele->setName($modelName)
                           ->setCreateAt($marqueAnnee)
                           ->setMarque($marque);
                    $manager->persist($modele);
                }

                $manager->persist($marque);
            }

       }

        $manager->flush();
    }
}
