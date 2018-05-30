<?php

namespace AppBundle\Resolver;

use AppBundle\Resolver\AbstractResolver;
use AppBundle\Entity\Auteur;

class AuteurResolver extends AbstractResolver {

    public function findAll() {
        return $this->em->getRepository('AppBundle:Auteur')->findAll();
    }

    public function find($id) {
        $auteur = $this->em->getRepository('AppBundle:Auteur')->find($id);

        if (!$auteur) {
            throw $this->createNotFoundException();
        }

        return $auteur;
    }

    /* public function create($title) {
      $todoItem = TodoItem::createFromTitle($title);
      $this->em->persist($todoItem);
      $this->em->flush();
      return $this->findAll();
      }

      public function toggleAll($checked) {
      $todoItems = $this->em->getRepository('AppBundle:TodoItem')->findAllOrdered();
      foreach ($todoItems as $todoItem) {
      $todoItem->setCompleted($checked);
      }
      $this->em->flush();
      return $todoItems;
      }

      public function toggle($id) {
      $todoItem = $this->em->getRepository('AppBundle:TodoItem')->find($id);
      if (!$todoItem) {
      throw $this->createNotFoundException();
      }
      $todoItem->setCompleted(!$todoItem->getCompleted());
      $this->em->flush();
      return $this->findAll();
      }

      public function destroy($id) {
      $todoItem = $this->em->getRepository('AppBundle:TodoItem')->find($id);
      if (!$todoItem) {
      throw $this->createNotFoundException();
      }
      $this->em->remove($todoItem);
      $this->em->flush();
      return $this->findAll();
      }

      public function save($id, $title) {
      $todoItem = $this->em->getRepository('AppBundle:TodoItem')->find($id);
      if (!$todoItem) {
      throw $this->createNotFoundException();
      }
      $todoItem->setTitle($title);
      $this->em->flush();
      return $this->findAll();
      }

      public function clearCompleted() {
      $this->em->getRepository('AppBundle:TodoItem')->removeCompleted();
      return $this->findAll();
      } */
}
