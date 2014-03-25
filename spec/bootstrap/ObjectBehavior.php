<?php namespace spec;

class ObjectBehavior extends \PhpSpec\ObjectBehavior
{
    /**
     * Custom matchers
     *
     * @return array
     */
    public function getMatchers()
    {
        return [
            'contain' => function($subject, $value) {
                return strpos($subject, $value) !== false;
            },
            'havePair' => function($subject, $key, $value) {
                return $subject[$key] == $value;
            },
            'haveKey' => function($subject, $key) {
                return is_array($subject) && array_key_exists($key, $subject);
            }
        ];
    }
}