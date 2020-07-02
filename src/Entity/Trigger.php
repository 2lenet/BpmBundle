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
     * @ORM\Column(name="code", type="string")
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="className", type="string")
     */
    private $className;

    /**
     * @var string
     *
     * @ORM\Column(name="entity_class", type="string")
     */
    private $entityClass;

    /**
     * @var string
     *
     * @ORM\Column(name="parameters", type="json", nullable=true)
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

    /**
     * @var string
     *
     * @ORM\Column(name="from_status", type="string")
     */
    private $from;

    /**
     * @var string
     *
     * @ORM\Column(name="to_status", type="string")
     */
    private $to;

    /**
     * @var boolean
     *
     * @ORM\Column(name="est_automatique", type="boolean")
     */
    private $estAutomatique;

    /**
     * Trigger constructor.
     */
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



    /**
     * Get the value of from
     *
     * @return  string
     */ 
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set the value of from
     *
     * @param  string  $from
     *
     * @return  self
     */ 
    public function setFrom(string $from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get the value of to
     *
     * @return  string
     */ 
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set the value of to
     *
     * @param  string  $to
     *
     * @return  self
     */ 
    public function setTo(string $to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get the value of code
     *
     * @return  string
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @param  string  $code
     *
     * @return  self
     */ 
    public function setCode(string $code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of entityClass
     *
     * @return  string
     */ 
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * Set the value of entityClass
     *
     * @param  string  $entityClass
     *
     * @return  self
     */ 
    public function setEntityClass(string $entityClass)
    {
        $this->entityClass = $entityClass;

        return $this;
    }


    /**
     * @return bool
     */
    public function isAutomatique(): bool
    {
        return $this->estAutomatique;
    }

    /**
     * @param bool $estAutomatique
     */
    public function setAutomatique(bool $estAutomatique): void
    {
        $this->estAutomatique = $estAutomatique;
    }
}
