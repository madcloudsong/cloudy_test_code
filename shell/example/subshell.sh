#!/bin/bash
#use {} to run command group in current shell
#use () to run command group in sub shell, the change for sub shell will not change parent shell, such as env

echo "begin test {} command group"
{
    cloudy="hello cloudy"
    echo "in {} command group: $cloudy"
}
echo "out {} command group: $cloudy"

echo ""
echo "begin test () command group"
#in sub shell you can exit as you like and will not exit current shell
(cloudy="oh cloudy";echo "in () command group: $cloudy";exit 1)
echo "out () command group: $cloudy"

#following shows || and &&
echo ""
echo "group1" && (echo "sub shell" && exit 2) && echo "end sub exit: $?"

echo ""
echo "group2" && (echo "sub shell" && exit 2) || echo "end sub exit: $?"

#because (echo "sub shell") exit with 0, "|| exit 2" will not be executed
echo ""
echo "group3" && (exit 1) || (echo "sub shell") || exit 2

#if need to run command in single line and process exit with echo, maybe this kind of command will work
echo ""
echo "group4" && (exit 1) || (echo "sub shell" && exit 2) || exit 3

echo "all done"

#after run the shell try echo $?, it will be 3

#output
#begin test {} command group
#in {} command group: hello cloudy
#out {} command group: hello cloudy
#
#begin test () command group
#in () command group: oh cloudy
#out () command group: hello cloudy
#
#group1
#sub shell
#
#group2
#sub shell
#end sub exit: 2
#
#group3
#sub shell
#
#group4
#sub shell


