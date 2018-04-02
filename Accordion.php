<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoryTree
 *
 * @ORM\Table(name="category_tree")
 * @ORM\Entity
 */
class CategoryTree
{
    /**
     * @var integer
     *
     * @ORM\Column(name="category_tree_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categoryTreeId;

    /**
     * @var string
     *
     * @ORM\Column(name="category_tree_value", type="text", length=65535, nullable=true)
     */
    private $categoryTreeValue;


    /**
     * Constructor
     */
    public function __construct()
    {
    }


    /**
     * Get categoryTreeId
     *
     * @return integer
     */
    public function getCategoryTreeId()
    {
        return $this->categoryTreeId;
    }


    /**
     * Set categoryTreeValue
     *
     * @param string $categoryTreeValue
     *
     * @return CategoryTree
     */
    public function setCategoryTreeValue($optionValue)
    {
        $this->categoryTreeValue = $categoryTreeValue;

        return $this;
    }

    /**
     * Get categoryTreeValue
     *
     * @return string
     */
    public function getCategoryTreeValue()
    {
        return $this->categoryTreeValue;
    }
}
