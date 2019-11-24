<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    /**
     * Load a few tags and articles to populate the database.
     * We need to require doctrine/doctrine-fixtures-bundle in the --dev environment only.
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Create a few tags
        foreach (['Sport', 'IT', 'Food', 'Travel', 'Music', 'Ecology'] as $title)
        {
            $tag = new Tag();
            $tag->setTitle($title);
            // Persist each tag individually
            $manager->persist($tag);
        }
        
        // Save all the tags simultaneously
        $manager->flush();
        
        // Create a few articles
        $articles = [
            ['title' => 'Our dams are nearly empty', 'body' => 'We might lack water supply next summer.', 'tag' => 'Ecology'],
            ['title' => 'New funny run', 'body' => 'Next year will take place a new kind of run in town.', 'tag' => 'Sport'],
            ['title' => 'New smartwatch', 'body' => 'Read more about our own top 10 smartwatches of 2019.', 'tag' => 'IT'],
            ['title' => 'To food or not to food', 'body' => 'A new bunch of it recipes for winter.', 'tag' => 'Food'],
        ];
        
        foreach ($articles as $data)
        {
            $article = new Article();
            $article->setTitle($data['title']);
            $article->setBody($data['body']);
            // Retrieve on previously tag
            $article->setTag($manager->getRepository(Tag::class)->findOneBy(['title' => $data['tag']]));
            // Persist the article
            $manager->persist($article);
        }
        
        // Write everything to the database
        $manager->flush();
    }
}
