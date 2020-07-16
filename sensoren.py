import os
from gpiozero import CPUTemperature
import time
import csv
import requests
from datetime import datetime

def getFreeDescription():
    free = os.popen("free -h")
    i = 0
    while True:
        i = i + 1
        line = free.readline()
        if i==1:
            return(line.split()[0:7])
                                 
def getFree():
    free = os.popen("free -h")
    i = 0
    while True:
        i = i + 1
        line = free.readline()
        if i==2:
            return(line.split()[0:7])

counter = 0
counter2 = 0
counter3 = 0
cpu = 0
headers = { 'User-Agent': 'Mozilla/5.0 (Windows NT 6.0; WOW64; rv:24.0) Gecko/20100101 Firefox/24.0' }

while True :

    if counter2 > 14:
        cpu = CPUTemperature()
        print(cpu.temperature)
        counter2 = 0
        payload = {'Sensor_ID':'1', 'name':'Templogger', 'Value':cpu.temperature}
    	r1 = requests.get('http://11800892.pxl-ea-ict.be/IoT/Project/Collector.php', payload, headers=headers)
    	print(r1.url)

    if counter > 29:
        description = getFreeDescription()
        mem = getFree()
        print(description[0] + " : " + mem[1])
        print(description[2] + " : " + mem[3])
        counter = 0
    	payload = {'Sensor_ID':'2', 'name':'Memorylogger','Value':mem[3][:3]}
    	r = requests.get('http://11800892.pxl-ea-ict.be/IoT/Project/Connector.php', payload, headers=headers)
    	# r2 = requests.get('http://11701205.pxl-ea-ict.be/ConnectorLast.php', payload2, headers=headers)
    	print(r.url)

    	#dt =  datetime.now().strftime('%Y-%m-%d %H:%M:%S')
		#with open ('sensorValues.csv', mode='a+') as senValues:
        	#senValues = csv.writer(senValues, delimiter=',',quotechar='"', quoting=csv.QUOTE_MINIMAL)
        	#senValues.writerow([dt, cpu.temperature, mem[1], mem[3]])
    	
    time.sleep(1)
    counter = counter + 1
    counter2 = counter2 + 1
