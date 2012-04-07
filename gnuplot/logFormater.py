fi = open('log',  'r')
fo = open('log2', 'w')

for line in fi:
    values=line.split(' ')
    #print(values)
    values[1]=values[1].strip()
    #print(values[1])
    if float(values[1]) < float(0):
	values.append(65536*255  + 255*0   + 1*0  )
	#print("-100")
    else:
	values.append(65536*0    + 255*0   + 1*255)
    fo.write(' '.join(map(str, values)) + '\n')