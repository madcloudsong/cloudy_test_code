using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Reflection;

namespace hello
{
    class Program
    {
        static void Main(string[] args)
        {
            //call static method
            string[] classes = { 
                                   "Reflect", //0
                                   "Hello", //1

                               };
            int index = 0;
            string cmd = classes[index];
            //Type tx = typeof(hello.Hello);
            Type tx = Type.GetType(new Program().GetType().Namespace + "." + cmd, true, true);
            MethodInfo mf = tx.GetMethod("run", BindingFlags.Public | BindingFlags.Static, null, new Type[]{}, null);
            int ret = (int)mf.Invoke(null, null);
            
        }
    }
}
