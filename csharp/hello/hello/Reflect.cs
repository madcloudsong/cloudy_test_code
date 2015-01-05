using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Reflection;

namespace hello
{
    class Reflect
    {
        public static int run()
        {
            //call static method
            string cmd = "Hello";
            //Type tx = typeof(hello.Hello);
            Type tx = Type.GetType(new Program().GetType().Namespace + "." + cmd, true, true);
            MethodInfo mf = tx.GetMethod("run", BindingFlags.Public | BindingFlags.Static, null, new Type[] { }, null);
            int ret = (int)mf.Invoke(null, null);
            Console.WriteLine(ret);

            //call non static method
            Hello p1 = new Hello();
            Type t = p1.GetType();
            MethodInfo mi = t.GetMethod("say", BindingFlags.Public | BindingFlags.Instance, null, new Type[] { }, null);

            //通过反射执行ReturnAutoID方法，返回AutoID值
            string strx = mi.Invoke(p1, null).ToString();
            Console.WriteLine(strx);
            return 0;
        }
    }
}
