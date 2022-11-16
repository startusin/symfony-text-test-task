<?php
namespace App\Controller;

use App\Model\Node;
use App\Service\FirstKataService;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/katas', name: 'katas_')]
class KatasController extends AbstractController
{
    #[Route(path: '/first', name: 'first', methods: ['POST'])]
    public function first(FirstKataService $service): Response
    {
        $nodeObj = new stdClass;
        $nodeObj->node = null;

        $nodeObjInit = new stdClass;
        $nodeObjInit->node = $nodeObj;

        $node = new Node($nodeObjInit);

        return $this->json([
            'count' => $service->size($node),
        ]);
    }
}
