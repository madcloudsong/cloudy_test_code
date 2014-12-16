#!/bin/bash
#use eval to exec cmd
function hello()
{
    echo "in func hello"
}

func=hello
echo $func
eval `echo $func`
eval hello

#output:
#hello
#in func hello
#in func hello
