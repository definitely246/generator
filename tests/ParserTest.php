<?php namespace Codesleeve\Generator;

use Twig_Environment, Twig_Token, Twig_Loader_Filesystem;

class ParserTest extends TestCase
{
    public function setUp()
    {
        $options = array(
            'tag_comment'     => array('{#', '#}'),
            'tag_block'       => array('{%', '%}'),
            'tag_variable'    => array('{{', '}}'),
            'whitespace_trim' => '-',
            'interpolation'   => array('#{', '}'),
        );

        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../examples/template1');
        $twig = new \Twig_Environment($loader);
        $lexer = new \Twig_Lexer($twig, $options);

        $twig->setLexer($lexer);

        $variables = array(
            'model' => 'user',
            'models' => 'users',
            'Model' => 'User',
            'Models' => 'Users',
            'belongsTo' => array(
                array(
                    'Name' => 'Subscription',
                    'name' => 'subscription',
                ),
             ),
            'hasMany' => array(
                array(
                    'Name' => 'Roles',
                    'name' => 'roles',
                )
            )
        );
        $output = $twig->render('model.php', $variables);
        dd($output);
    }

    public function testCanCompileTemplate()
    {
//        $output = $this->parser->parse($this->template);

        //var_dump($this->template);
    }


}