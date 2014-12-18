#!/bin/bash
#use eval to exec cmd

function show() {
    echo -e "\e[36;49;1m " $1 " \e[35;49;1m OUTPUT: " "\e[32;49;1m " `eval echo $1` "\e[39;49;0m"
}
cloud=1
cloudysong=2
foo=/first/second/third/hello

echo 'cloud=1'
echo 'cloudysong=2'
echo 'foo=/first/second/third/hello'

show '$cloud $cloudysong ${cloud}ysong'
#use # to compute strlen
show '${#cloud}'

#use # to delete string from head, if *, lazy match
show '${foo#/first}'
show '${foo#/*/}'
show '${foo#/*/*/}'

#use # to delete string from head, if *, greedy match
show '${foo##/*/}'

#use % to delete string from tail, if * lazy match
show '${foo%/*}'
show '${foo%/*/*}'
show '${foo%/hello}'

#use % to delete string from head, if *, greedy match
show '${foo%%s*}'

#use : to slice string with ${var:index:length}
show '${foo:3:4}'

#use can use math expression
show '${foo:2*2:2+2}'
show '${foo:${#foo}-7:5}'

#use / to replace string with ${var/A/B} lazy match
show '${foo/\//|}'
#use // to replace string with ${var//A/B} greedy match
show '${foo//\//|}'

#output:
#cloud=1
#cloudysong=2
#foo=/first/second/third/hello
#  $cloud $cloudysong ${cloud}ysong   OUTPUT:    1 2 1ysong 
#  ${#cloud}   OUTPUT:    1 
#  ${foo#/first}   OUTPUT:    /second/third/hello 
#  ${foo#/*/}   OUTPUT:    second/third/hello 
#  ${foo#/*/*/}   OUTPUT:    third/hello 
#  ${foo##/*/}   OUTPUT:    hello 
#  ${foo%/*}   OUTPUT:    /first/second/third 
#  ${foo%/*/*}   OUTPUT:    /first/second 
#  ${foo%/hello}   OUTPUT:    /first/second/third 
#  ${foo%%s*}   OUTPUT:    /fir 
#  ${foo:3:4}   OUTPUT:    rst/ 
#  ${foo:2*2:2+2}   OUTPUT:    st/s 
#  ${foo:${#foo}-7:5}   OUTPUT:    d/hel 
#  ${foo/\//|}   OUTPUT:    |first/second/third/hello 
#  ${foo//\//|}   OUTPUT:    |first|second|third|hello 
