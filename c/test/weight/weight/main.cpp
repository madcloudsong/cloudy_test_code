//
//  main.cpp
//  weight
//
//  Created by madcloud on 15/11/12.
//  Copyright (c) 2015年 itsong. All rights reserved.
//

#include <stdio.h>
#include <sys/timeb.h>

#define N 4

#define DEBUG 0

int input[N][N];

int weight[3] = {1, 3, 5};
int mark[N][N] = {0};
int maxi[3][20] = {};
int maxj[3][20] = {};
int length[3] = {};

void read() {
    FILE *fp = fopen("/Users/madcloud/Documents/git/cloudy_test_code/c/test/weight/weight/input", "rw");
    if(!fp){
        printf("openfile fail\n");
        return;
    }
    for(int i = 0 ; i < N; i++) {
        for(int j = 0; j < N; j++){
            fscanf(fp, "%d", &input[i][j]);
        }
    }
    fclose(fp);
}

void show() {
    for(int i = 0 ; i < N; i++) {
        for(int j = 0; j < N; j++){
            printf("%d ", input[i][j]);
        }
        printf("\n");
    }
}

int checkCanGo(int mark[][4], int i, int j, int goal) {
    if(i < 0 || i >= N || j < 0 || j >= N || input[i][j] != goal || mark[i][j] == 1) {
        if(DEBUG)printf("check: (%d, %d) failed, %d\n", i, j, mark[i][j]);
        return 0;
    }else{
        if(DEBUG)printf("check: (%d, %d) ok, %d\n", i, j, mark[i][j]);
        return 1;
    }
}

int haha(int mark[][4], int m, int n, int goal, int maxi[], int maxj[], int *length) {
    int max = 0;
    int ai[8] = {m-1, m-1, m-1, m,  m, m+1, m+1, m+1};
    int aj[8] = {n-1, n, n+1, n-1, n+1, n-1, n, n+1};
    mark[m][n] = 1;
    maxi[(*length)] = m;
    maxj[(*length)] = n;
    (*length)++;
    if(DEBUG)
    printf("visit %d, %d, %d\n", m, n, *length);
    int tempi[20];
    int tempj[20];
    int templength = *length;
    for(int y = 0; y < *length; y++) {
        tempi[y] = maxi[y];
        tempj[y] = maxj[y];
    }
    int goon = 0;
    for(int x = 0; x < 8 ;x ++) {
        int newx = ai[x], newy = aj[x];
        
        if(checkCanGo(mark, newx, newy, goal)) {
            goon = 1;
            int tmark[N][N];
            int tmaxi[20];
            int tmaxj[20];
            int tlength = templength;
            for(int y = 0; y < templength; y++) {
                tmaxi[y] = tempi[y];
                tmaxj[y] = tempj[y];
            }
            for(int i = 0 ; i < N; i++) {
                for(int j = 0; j < N; j++){
                    tmark[i][j] = mark[i][j];
                }
            }
            int ret = haha(tmark, newx, newy, goal, tmaxi, tmaxj, &tlength);
            if(ret > max) {
                max = ret;
                for(int y = 0; y < tlength; y++) {
                    maxi[y] = tmaxi[y];
                    maxj[y] = tmaxj[y];
                    if(DEBUG)
                    printf("(%d, %d)", tmaxi[y], tmaxj[y]);
                }
                *length = tlength;
                if(DEBUG)
                printf("\nfind max %d, length: %d\n", ret, tlength);
            }
            
         }
    }
    
    return max + 1;
}

int run(int goal) {
    int maxWeight = 0;
    for(int i = 0 ; i < N; i++) {
        for(int j = 0; j < N; j++){
            if(input[i][j] == goal){
                int tmark[N][N] = {0};
                int tmaxi[20];
                int tmaxj[20];
                int tlength = 0;
                
                int temp = haha(tmark, i, j, goal, tmaxi, tmaxj, &tlength);
                if(temp > maxWeight) {
                    maxWeight = temp;
                    length[goal] = tlength;
                    for(int y = 0; y < tlength; y++) {
                        maxi[goal][y] = tmaxi[y];
                        maxj[goal][y] = tmaxj[y];
                    }
                }
            }
        }
    }
    return maxWeight;
}

long long getSystemTime() {
    struct timeb t;
    ftime(&t);
    return 1000 * t.time + t.millitm;
}

int main(int argc, const char * argv[]) {
    double start = getSystemTime();
    read();
    show();
    int max = 0;
    int maxtype = 0;
    int maxlength = 0;
    for(int i = 2; i >=0; i--) {
        int result = run(i);
        if(result * weight[i] > max) {
            maxtype = i;
            maxlength = result;
            max = result * weight[i];
        }
    }
    printf("max length: %d\n", maxlength);
    printf("max type: %d\n", maxtype);
    for(int y = 0; y < length[maxtype]; y++) {
        printf("(%d, %d)", maxi[maxtype][y], maxj[maxtype][y]);
    }
    printf("\n");
    printf("max weight: %d\n", max);

    printf("\ntime: %lf\n", getSystemTime() - start);
    return 0;
}










