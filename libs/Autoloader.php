<?php

function my_autoloader($class) {

    // explode namespace
    $classes = explode('\\', $class);
    if(in_array($classes[0], ['Be', 'Libs','Modules']))
    {
        $classType = $classes[0];
        unset($classes[0]);
        if($classType == 'Libs')
        {
            $importClass = 'libs/' . implode('/',$classes);
            
        }

        else if($classType == 'Modules')
        {
            $classes[1] = strtolower($classes[1]);
            $classes[2] = strtolower($classes[2]);
            
            $importClass = '../modules/' . implode('/',$classes);
        }

        else if($classType == 'Be')
        {
            // $classes[1] = strtolower($classes[1]);
            // $classes[2] = strtolower($classes[2]);
            
            $importClass = 'be/' . implode('/',$classes);
            // echo $importClass;
        }

        if(file_exists($importClass.'.php'))
        {
            require $importClass.'.php';
        }
        else
        {
            die($class . ' is not valid');
        }
    }
    else
    {
        $importClass = implode('/',$classes);

        if(file_exists($importClass.'.php'))
        {
            require $importClass.'.php';
        }
        else
        {
            die($class . ' is not valid');
        }
    }
}

spl_autoload_register('my_autoloader');
