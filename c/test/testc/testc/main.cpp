//
//  main.cpp
//  testc
//
//  Created by madcloud on 15/8/19.
//  Copyright (c) 2015年 itsong. All rights reserved.
//

#include <iostream>

const char * testString() {
    std::string haha = "haha";
    printf("test String : %s\n", haha.c_str());
    return haha.c_str();
}

std::string haha2 = "haha2";
const char * testString2() {
    printf("test String : %s\n", haha2.c_str());
    return haha2.c_str();
}

int main(int argc, const char * argv[]) {
    // insert code here...
    std::cout << "Hello, World!\n";
    printf("%s\n", testString());
    
    printf("*********\n");
    const char * x = testString();
    printf("%s\n", x);
    
    printf("******************\n");
    printf("%s\n", testString2());
    
    printf("*********\n");
    const char * x2 = testString2();
    printf("%s\n", x2);

    return 0;
}
