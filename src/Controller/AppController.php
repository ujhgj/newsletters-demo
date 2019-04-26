<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Newsletter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    public function index(Request $request)
    {
        $params = [
            'page' => 'index',
            'hostname' => $_ENV['HOSTNAME'],
        ];

        if ($request->getMethod() === 'POST') {
            $this->createNewsletter($_REQUEST);
            $params['flash'] = 'Newsletter created successfully.';
        }

        return $this->render('form.html.twig', $params);
    }

    private function createNewsletter($data) {
        $m = $this->getDoctrine()->getManager();
        $m->persist(
            (new Newsletter)
                ->setTitle($data['title'])
                ->setText($data['text'])
                ->setPending(1000)
                ->setOverall(1000)
        );
        $m->flush();
    }

    public function reports(Request $request)
    {
        $params = [
            'page' => 'reports',
            'hostname' => $_ENV['HOSTNAME'],
            'newsletters' => $this->getDoctrine()->getRepository(\App\Entity\Newsletter::class)->findAll()
        ];

        return $this->render('reports.html.twig', $params);
    }
}