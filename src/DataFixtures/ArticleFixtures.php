<?php


namespace App\DataFixtures;


use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies ()
    {

        return [CategoryFixtures::class];

    }

    public function load ( ObjectManager $manager )
    {
        for ($i = 0; $i < 50; $i++) {

            $faker = Faker\Factory::create('fr_FR');
            $article = new Article();
            $article->setTitle(mb_strtolower($faker->word));
            $article->setContent(mb_strtolower($faker->paragraph($nbSentences = 3, $variableNbSentences = true)));

            $manager->persist($article);
            $article->setCategory($this->getReference('categorie_' . rand(1 , 4) ));
        }
        $manager->flush();
    }
}