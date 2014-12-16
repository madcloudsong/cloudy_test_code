#!/bin/bash
if [ $# -gt 0 ];then
    exec 0<$1;
fi

while read line
do 
    echo $line;
done<&0;

exec 0&-;