<?php
namespace Lle\BpmBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Lle\BpmBundle\Form\Transformer\ArrayToJsonTransformer;

class JsonType extends AbstractType {


    public function getParent()
    {
        return TextareaType::class;
    }

    public function getName()
    {
        return 'lle.bpm.json';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new ArrayToJsonTransformer());
    }


}