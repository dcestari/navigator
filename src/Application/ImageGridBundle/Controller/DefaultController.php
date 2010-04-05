<?php

namespace Application\ImageGridBundle\Controller;

use Symfony\Framework\WebBundle\Controller;

class DefaultController extends Controller
{
  public function indexAction()
  {
    $request = $this->getRequest();

    $x_offset = $request->getParameter('x', 0);
    $y_offset = $request->getParameter('y', 0);
    $scale = $request->getParameter('scale', 0.4);

    $x_limit = $x_offset + 5;
    $y_limit = $y_offset + 5;

    return $this->render('ImageGridBundle:Default:index',array(
      'x_offset' => $x_offset,
      'y_offset' => $y_offset,
      'x_limit' => $x_limit,
      'y_limit' => $y_limit,
      'scale' => $scale,
    ));
  }
  public function showAction($x, $y, $scale = 1, $w = 100, $h = 100)
  {
    $file = '/home/dcestari/Downloads/image.jpg';
    $hash = md5_file($file);

    $dirs = array(
      $this->container->getKernelService()->getRootDir(),
      '..',
      'web',
      'cache',
      $hash, $scale, $w, $h,
      sprintf('%sx%s.jpeg', $x, $y),
    );

    $filename = implode(DIRECTORY_SEPARATOR, $dirs);

    $response = $this->createResponse($filename);
    $response->setHeader('Content-Type', 'image/jpeg');
    $response->setHeader('X-SendFile', $filename);

    return $response;
  }
}

