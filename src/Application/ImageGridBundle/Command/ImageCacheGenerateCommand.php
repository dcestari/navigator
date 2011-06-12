<?php

namespace Application\ImageGridBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

class ImageCacheGenerateCommand extends Command
{
  protected function configure()
  {
    $this
      ->setDefinition(array(
        new InputArgument('source', InputArgument::REQUIRED, 'The source image'),
        new InputArgument('target', InputArgument::REQUIRED, 'The target directory'),
      ))
      ->setName('image-cache:generate')
    ;
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $scale = 0.4;
    $w = 100;
    $h = 100;
    $source = $input->getArgument('source');
    $target = $input->getArgument('target');

    $output->writeln(sprintf('<info>source</info> %s', $source));
    $output->writeln(sprintf('<info>target</info> %s', $target));

    if (!is_file($source))
    {
      throw new \InvalidArgumentException(sprintf('"source" must be a file, "%s" given', $source));
    }

    if (file_exists($target) && !is_dir($target))
    {
      throw new \InvalidArgumentException(sprintf('"target" must be a directory, "%s" given', $target));
    }

    $source_hash = md5_file($source);

    $dirs = array(
      $target, $source_hash, $scale, $w, $h,
    );

    $path = '';

    foreach ($dirs as $dir)
    {
      if (!empty($path))
      {
        $path .= DIRECTORY_SEPARATOR;
      }

      $path .= $dir;

      if (!file_exists($path))
      {
        mkdir($path, 0755, true);
      }
    }

    list($width, $height) = getimagesize($source);
    $new_width = $width * $scale;
    $new_height = $height * $scale;

    $dst_w = $w;
    $dst_h = $h;
    $src_w = $dst_w / $scale;
    $src_h = $dst_h / $scale;

    $max_x = $new_width / $dst_w;
    $max_y = $new_height / $dst_h;

    for ($src_x = 0, $x = 0; $src_x < $width; $src_x += $src_w, $x++)
    {
      for ($src_y = 0, $y = 0; $src_y < $height; $src_y += $src_h, $y++)
      {
        $output->writeln(sprintf('<info>generating</info> (%s, %s)', $x, $y));

        $scaled = imagecreatetruecolor($dst_w, $dst_h);
        $original = imagecreatefromjpeg($source);
        imagecopyresized($scaled, $original, 0, 0, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

        $target_file = $path . DIRECTORY_SEPARATOR . sprintf('%dx%d.jpeg', $x, $y);

        imagejpeg($scaled, $target_file, 100);
      }
    }

    $output->writeln('<info>done</info>');
  }
}

