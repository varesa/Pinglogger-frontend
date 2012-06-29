import sys

fnamein  = sys.argv[1]
fnameout = sys.argv[2]

if (not fnamein) or (not fnameout):
    sys.exit("Please provide log-in and log-out as first and second argument")
#fi = open('log',  'r')
#fo = open('log2', 'w')

print("in: " + fnamein + ", out: " + fnameout)

fi = open(fnamein,  'r')
fo = open(fnameout, 'w')

errors = 0

for line in fi:
    values=line.split(' ')
    #print(values)
    try:
	values[1]=values[1].strip()
	#print(values[1])
	if float(values[1]) < float(0):
	    values.append(65536*255  + 255*0   + 1*0  )
	    #print("-100")
	else:
	    values.append(65536*0    + 255*0   + 1*255)
	fo.write(' '.join(map(str, values)) + '\n')
    except IndexError:
	errors += 1
	pass # Skip lines that have problems

print "Errors in file: " + str(errors)