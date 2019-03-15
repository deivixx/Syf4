<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


class NoteControllerTest extends WebTestCase {

    private $client = null;

    public function testNoteIndexWithoutLogin() {

        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/notes');
        $this->assertSame(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
        $this->assertTrue($this->client->getResponse()->headers->contains(
                        'location', '/login'
        ));

        $crawler = $this->client->followRedirect();
        $this->assertSame('Login', $crawler->filter('h1')->text());
    }

    public function testNoteIndexWithLogin() {

        $this->logIn();
        $crawler = $this->client->request('GET', '/notes');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertSame(' Nueva Nota', $crawler->filter('a.Link')->text());
        $this->logOut();
    }

    public function testClickNewNote() {

        $this->logIn();
        $crawler = $this->client->request('GET', '/notes');
        $crawler = $this->client->clickLink('Nueva Nota');
        $this->assertSame('Título', $crawler->filter('label[for="note_title"]')->text());
        $this->logOut();
    }

    public function testNewNote() {

        $this->logIn();
        $crawler = $this->client->request('GET', '/notes/new');
        $crawler = $this->client->submitForm('Guardar Nota', [
            'note[title]' => 'TEST',
        ]);
        $crawler = $this->client->followRedirect();
        $this->assertContains('Nota creada con éxito', $crawler->filter('div.alert')->text());
        $deleteURL = $crawler->filter('button:contains("TEST") + a + a')->attr('href');
        $this->client->request('GET', $deleteURL);

        $this->logOut();
    }

    private function logIn() {
        $this->client = static::createClient([], [
                    'PHP_AUTH_USER' => 'admin@ow.es',
                    'PHP_AUTH_PW' => 'admin',
        ]);
    }

    private function logOut() {
        $this->client->request('GET', '/logout');
    }

}
