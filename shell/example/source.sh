#!/bin/bash
#directly use . to use sub shell, fork another process to run the shell, so pwd and env is not changed, has no change to the parent process
#use source to run the shell in current process, so the pwd and env will be changed, if source a shell including exit, hey, you will be exited
#use exec to run the shell in current process, and end current shell

currentpwd=`pwd`

echo '#!/bin/bash
cd /usr/local
echo "in changedir pwd: `pwd`"
cloudy="hello cloudy"
#try including exit 2 to make source exit
#exit 2        
' > changedir.sh
chmod +x changedir.sh

echo "current pwd: $currentpwd"

echo ""
echo "before ."
echo "before cloudy=$cloudy"
./changedir.sh
echo "pwd: `pwd`"
echo "cloudy=$cloudy"
cd $currentpwd
echo "after ."

echo ""
echo "before source"
echo "before cloudy=$cloudy"
source ./changedir.sh
echo "pwd: `pwd`"
echo "cloudy=$cloudy"
cloudy="new"
cd $currentpwd
echo "after source"

echo ""
echo "before exec"
echo "before cloudy=$cloudy"
exec ./changedir.sh
#the shell is end, cmd following will not run
echo "pwd: `pwd`"
echo "cloudy=$cloudy"
cd $currentpwd
echo "after exec"
echo ""
echo "all done"

#output:
#current pwd: /data/web_deployment/tmp
#
#before .
#before cloudy=
#in changedir pwd: /usr/local
#pwd: /data/web_deployment/tmp
#cloudy=
#after .
#
#before source
#before cloudy=
#in changedir pwd: /usr/local
#pwd: /usr/local
#cloudy=hello cloudy
#after source

before exec
before cloudy=new
in changedir pwd: /usr/local
