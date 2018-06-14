<?php
namespace Lle\BpmBundle\Form\Type;

use Lle\BpmBundle\Service\Tag\ActionChain;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActionChoiceType extends AbstractType {


    private $actionChain;

    public function getParent()
    {
        return choiceType::class;
    }

    public function __construct(ActionChain $actionChain){
        $this->actionChain = $actionChain;
    }

    public function getName()
    {
        return 'lle.bpm.action_choice';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $choices = [];
        foreach($this->actionChain->getActions() as $k => $action){
            /* @var \Lle\BpmBundle\Action\ActionInterface $action */
            $choices[ucfirst($action::getName())] = $k;
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