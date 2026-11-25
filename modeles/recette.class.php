<?php

/**
 * @file    recette.class.php
 * @author  Antoine Moulin
 * @brief   Définit une classe permettant de représenter une Recette avec
 *          ses IngredientQuantifie et sa Categorie (entrée, dessert...)
 * @version 0.1
 * @date    02/09/2024
 */


/**
 * @file    recette.class.php
 * @author  Antoine Moulin
 * @brief   Définit une classe permettant de représenter une Recette avec
 *          ses IngredientQuantifie et sa Categorie (entrée, dessert...)
 * @version 0.1
 * @date    02/09/2024
 */
class Recette
{
    private int|null $id;                 ///< Identifiant unique de la recette.
    private string|null $nom;             ///< Nom de la recette.
    private string|null $description;     ///< Description textuelle de la recette.
    private string|null $image;           ///< Chemin vers l'image illustrant la recette.
    private ?Categorie $categorie;        ///< Catégorie (entrée, plat, dessert...).
    private ?array $ingredientQuantifies;  ///< Liste d'IngredientQuantifie.



    /**
     * Construit un nouvel objet Recette
     *
     * @param integer|null $id L'identifiant de la Recette
     * @param string|null $nom Le nom de la Recette
     * @param string|null $description  La description de la Recette
     * @param string|null $image Chemin vers l'image qui représente la Recette
     * @param Categorie|null $categorie La Categorie de la Recette
     * @param array|null $ingredientQuantifies Le tableau des ingrédients quantifiés de la Recette
     */
    public function __construct(?int $id = null, ?string $nom = null, ?string $description = null, ?string $image = null, ?Categorie $categorie = null, ?array $ingredientQuantifies = null)
    {
        $this->setId($id);
        $this->setNom($nom);
        $this->setDescription($description);
        $this->setImage($image);
        $this->setCategorie($categorie);
        $this->setIngredientQuantifies($ingredientQuantifies);
    }

    /**
     * Undocumented function
     *
     * @return integer|null L'identifiant de la recette
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): void
    {
        $this->categorie = $categorie;
    }

    public function getIngredientQuantifies(): ?array
    {
        if ($this->ingredientQuantifies == null)
        {
            $db = Bd::getInstance();
            $pdo = $db->getConnection();
            $manager = new IngredientQuantifieDao($pdo);
            $this->ingredientQuantifies = $manager->findIngredientQuantifieByRecette($this->id);
        }
        return $this->ingredientQuantifies;
    }

    public function setIngredientQuantifies(?array $ingredientQuantifies): void
    {
        $this->ingredientQuantifies = $ingredientQuantifies;
    }
}
