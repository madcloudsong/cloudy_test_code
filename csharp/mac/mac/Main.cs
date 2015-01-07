using System;
using System.Reflection;

namespace mac
{
	class MainClass
	{
		static void Main(string[] args)
		{
			//call static method
			string[] classes = { 
				"Value", //0
				"Hello", //1
				
			};
			int index = 0;
			string cmd = classes[index];
			//Type tx = typeof(hello.Hello);
			Type tx = Type.GetType(new MainClass().GetType().Namespace + "." + cmd, true, true);
			MethodInfo mf = tx.GetMethod("run", BindingFlags.Public | BindingFlags.Static, null, new Type[]{}, null);
			int ret = (int)mf.Invoke(null, null);
			
		}
	}
}
