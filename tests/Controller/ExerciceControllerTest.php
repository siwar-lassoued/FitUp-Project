<?php

namespace App\Tests\Controller;

use App\Entity\Exercice;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ExerciceControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/exercice/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Exercice::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Exercice index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'exercice[nom]' => 'Testing',
            'exercice[description]' => 'Testing',
            'exercice[duree]' => 'Testing',
            'exercice[coachs]' => 'Testing',
            'exercice[user]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Exercice();
        $fixture->setNom('My Title');
        $fixture->setDescription('My Title');
        $fixture->setDuree('My Title');
        $fixture->setCoachs('My Title');
        $fixture->setUser('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Exercice');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Exercice();
        $fixture->setNom('Value');
        $fixture->setDescription('Value');
        $fixture->setDuree('Value');
        $fixture->setCoachs('Value');
        $fixture->setUser('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'exercice[nom]' => 'Something New',
            'exercice[description]' => 'Something New',
            'exercice[duree]' => 'Something New',
            'exercice[coachs]' => 'Something New',
            'exercice[user]' => 'Something New',
        ]);

        self::assertResponseRedirects('/exercice/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getDuree());
        self::assertSame('Something New', $fixture[0]->getCoachs());
        self::assertSame('Something New', $fixture[0]->getUser());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Exercice();
        $fixture->setNom('Value');
        $fixture->setDescription('Value');
        $fixture->setDuree('Value');
        $fixture->setCoachs('Value');
        $fixture->setUser('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/exercice/');
        self::assertSame(0, $this->repository->count([]));
    }
}
