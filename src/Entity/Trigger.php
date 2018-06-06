<?php

namespace Lle\BpmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trigger
 *
 * @ORM\Table(name="lle_bpm_trigger")
 * @ORM\Entity(repositoryClass="Lle\BpmBundle\Repository\TriggerRepository")
 */

class Trigger
{


    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="className", type="string")
     */
    private $className;

    /**
     * @var string
     *
     * @ORM\Column(name="parameters", type="json")
     */
    private $parameters;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @ORM\ManyToMany(targetEntity="Action",inversedBy="triggers", cascade={"persist"})
     * @ORM\JoinTable(name="lle_bpm_trigger_action")
     */
    private $actions;

    public function __construct()
    {
      $this->actions = new ArrayCollection();
    }

    public function __toString(){
        return (string) $this->getName();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of Class Name
     *
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Set the value of Class Name
     *
     * @param string className
     *
     * @return self
     */
    public function setClassName($className)
    {
        $this->className = $className;

        return $this;
    }

    /**
     * Get the value of Parameters
     *
     * @return string
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Set the value of Parameters
     *
     * @param string parameters
     *
     * @return self
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * Get the value of Active
     *
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of Active
     *
     * @param string active
     *
     * @return self
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the value of Actions
     *
     * @return mixed
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Set the value of Actions
     *
     * @param mixed actions
     *
     * @return self
     */
    public function setActions($actions)
    {
        $this->actions = $actions;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function addAction(Action $action){
        $this->actions->add($action);
    }

    public function removeAction(Action $action)
    {
        $this->actions->removeElement($action);
    }


}
