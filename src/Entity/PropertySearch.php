<?php

namespace App\Entity;

class PropertySearch
{

   private $prenom;
   
   
   public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }
}