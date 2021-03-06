<?php

/*
 * This file is part of the LEGO project.
 *
 * (c) Joris Saenger <joris.saenger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lle\BpmBundle\Form\Transformer;

use Symfony\Component\Form\DataTransformerInterface;

class ArrayToJsonTransformer implements DataTransformerInterface
{

    public function transform($array)
    {
        if (null === $array) {
            return '';
        }
        return json_encode($array);
    }

    public function reverseTransform($json)
    {
        if (empty($json)) {
            return;
        }
        $json = str_replace('\n', '', $json);
        return json_decode($json,true);
    }
}