<?php

namespace Application\ImageGridBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
  public function indexAction()
  {
    $request = $this->getRequest();

    $x_offset = $request->query->get('x', 0);
    $y_offset = $request->query->get('y', 0);
    $scale = $request->query->get('scale', 0.4);
    $x_limit = $x_offset + 5;
    $y_limit = $y_offset + 5;

    return $this->render('ApplicationImageGridBundle:Default:index.html.twig', array(
      'x_offset' => $x_offset,
      'y_offset' => $y_offset,
      'x_limit' => $x_limit,
      'y_limit' => $y_limit,
      'scale' => $scale,
    ));
  }
  public function showAction($x, $y, $scale = 1, $w = 100, $h = 100)
  {
    $file = $this->container->getParameter('kernel.root_dir') . '/../codo.jpg';
    $hash = md5_file($file);

    $dirs = array(
      $this->container->getParameter('kernel.root_dir'),
      '..',
      'web',
      'cache',
      $hash, $scale, $w, $h,
      sprintf('%sx%s.jpeg', $x, $y),
    );

    $filename = implode(DIRECTORY_SEPARATOR, $dirs);

    $response = new Response();
    $response->headers->set('Content-Type', 'image/jpeg');
    $response->headers->set('X-SendFile', $filename);

    return $response;
  }
}

