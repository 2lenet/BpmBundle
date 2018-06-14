<?php
namespace Lle\BpmBundle\Form\Type;

use Lle\BpmBundle\Service\Tag\TriggerChain;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TriggerChoiceType extends AbstractType {


    private $triggerChain;

    public function getParent()
    {
        return choiceType::class;
    }

    public function __construct(TriggerChain $triggerChain){
        $this->triggerChain = $triggerChain;
    }

    public function getName()
    {
        return 'lle.bpm.trigger_choice';
    }
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $choices = [];
        foreach($this->triggerChain->getTriggers() as $k => $trigger){
            /* @var \Lle\BpmBundle\Trigger\TriggerInterface $trigger */
            $choices[ucfirst($trigger::getName())] = $k;
        }
        $resolver->setDefaults(array(
            "choices" => $choices,
            "json_field" => null
        ));
    }

    public function buildView(FormView $view, FormInterface $form, array $options){
        $view->vars['json_field'] = str_replace($view->vars['name'], $options['json_field'], $view->vars['id']);
    }

}