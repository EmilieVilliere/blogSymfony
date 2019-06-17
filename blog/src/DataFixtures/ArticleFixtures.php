<?php


namespace App\DataFixtures;


use App\Entity\Article;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 50; $i ++)
        {
            $article = new Article();
            $faker = Faker\Factory::create('fr_FR');
            $article->setTitle(mb_strtolower($faker->sentence(6, true)));
            $article->setContent(mb_strtolower($faker->text(200)));
            $manager->persist($article);
            $article->setCategory($this->getReference('categorie_0'));
            $manager->flush();
        }

    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}