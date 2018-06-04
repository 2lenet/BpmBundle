<?php

namespace Lle\BpmBundle\Entity;

/**
 * Trigger
 *
 * @ORM\Table(name="lle_bpm_action")
 * @ORM\Entity(repositoryClass="Lle\BpmBundle\Entity\ActionRepository")
 */

class Action
{

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
 * @ORM\Column(name="active", type="boolean")
 */
private $active;

/**
 * @ORM\ManyToOne(targetEntity="Trigger", inversedBy="actions", cascade={"persist"})
 */
private $trigger;


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
     * Get the value of Trigger
     *
     * @return mixed
     */
    public function getTrigger()
    {
        return $this->trigger;
    }

    /**
     * Set the value of Trigger
     *
     * @param mixed trigger
     *
     * @return self
     */
    public function setTrigger($trigger)
    {
        $this->trigger = $trigger;

        return $this;
    }

}
