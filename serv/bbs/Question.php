<?php

namespace Labor\Serv\Bbs;

use Phalcon\Di, Phalcon\Db;

/**
 * This is an example model, change it by yourself.
 *
 */
class Question extends \Phalcon\Mvc\Model
{
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {   
        return 'question';
    }

    /** 
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AppnameZhaoyishengQuestionLog[]
     */
    public static function find($parameters = null)
    {   
        return parent::find($parameters);
    }   

    /** 
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AppnameZhaoyishengQuestionLog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Ask example.
     *
     * @farwish
     */
    public function ask($title)
    {
        return "你提的问题是：{$title}\n";
    }
}
