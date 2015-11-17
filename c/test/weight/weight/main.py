#-*- encoding:UTF-8 -*-
filehandler = open('input','r')

import math
import time

input = [([0] * 4) for i in range(4)]
mark = [([0] * 4) for i in range(4)]
maxi = [([0] * 20) for i in range(3)]
maxj = [([0] * 20) for i in range(3)]
length = [0] * 3
weight = [1, 3, 5]


def read():
	for i in range(0, 4):
		s = filehandler.readline()
		s = s.strip("\n");
		x = s.split(" ")
		for j in range(0, 4):
			input[i][j] = (int)(x[j])


def checkCanGo(mark, i, j, goal):
	if(i < 0 or i >=4 or j<0 or j>=4 or input[i][j]!=goal or mark[i][j] == 1):
		return 0
	else:
		return 1


def haha(mark, m, n, goal, maxi, maxj, length):
	max = 0
	
	ai = [m-1, m-1, m-1, m,  m, m+1, m+1, m+1]
	aj = [n-1, n, n+1, n-1, n+1, n-1, n, n+1]
	
	mark[m][n] = 1
	maxi[length] = m
	maxj[length] = n
	length += 1
	maxlength = length
	tempi = ([0] * 20)
	tempj = ([0] * 20)
	templength = length
	for y in range(length):
		tempi[y] = maxi[y]
		tempj[y] = maxj[y]
	goon = 0
	for x in range(8):
		newx = ai[x]
		newy = aj[x]
		if(checkCanGo(mark, newx, newy, goal)):
			goon = 1;
			tmark = [([0] * 4) for i in range(4)]
			tmaxi = ([0] * 20)
			tmaxj = ([0] * 20)
			tlength = templength
			for y in range(templength):
				tmaxi[y] = tempi[y]
				tmaxj[y] = tempj[y]
			for i in range(4):
				for j in range(4):
					tmark[i][j] = mark[i][j]
			(ret, tl) = haha(tmark, newx, newy, goal, tmaxi, tmaxj, tlength)
			tlength = tl
			if(ret > max):
				max = ret
				maxlength = tl
				for y in range(tlength):
					maxi[y] = tmaxi[y]
					maxj[y] = tmaxj[y]
	
	return (max+1, maxlength)

def run(goal):
	maxWeight = 0
	for i in range(4):
		for j in range(4):
			if(input[i][j] == goal):
				tmark = [([0] * 4) for i in range(4)]
				tmaxi = ([0] * 20)
				tmaxj = ([0] * 20)
				tlength = 0
				(temp, tl) = haha(tmark, i, j, goal, tmaxi, tmaxj, tlength)
				tlength = tl

				if(temp > maxWeight):
					maxWeight = temp
					length[goal] = tlength

					for y in range(tlength):
						maxi[goal][y] = tmaxi[y]
						maxj[goal][y] = tmaxj[y]
	return maxWeight




read()
print input
start = time.time()
#print start
max = 0
maxtype = 0
maxlength = 0
for i in range(2, -1, -1):
	result = run(i)
	if (result * weight[i] > max):
		maxtype = i
		maxlength = result
		max = result * weight[i]
	if(max > 40):
		break

print "max length: %d"%(maxlength)
#print "max type: %d"%(maxtype)
for y in range(length[maxtype]):
	print "(%d, %d)"%(maxi[maxtype][y],maxj[maxtype][y])
print "max weight : %d\n"%(max)

end = time.time()
#print end
print "time is : %f"%(end-start)


















