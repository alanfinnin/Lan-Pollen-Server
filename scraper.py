from lxml import html
from lxml import etree
from datetime import datetime
import json
import schedule
import time
import requests

def job(t):
	page = requests.get('https://weather.com/en-IE/forecast/allergy/l/8e9eed28e3b94653bbc53ba771d8cf033fb361e253901b6cdcbf58f4eb9238ec')
	tree = html.fromstring(page.content)


	types = tree.xpath('//h3[@class="_-_-components-src-organism-PollenBreakdown-PollenBreakdown--pollenType--y4gFi"]/text()')

	items = tree.xpath('//li[@class="_-_-components-src-organism-PollenBreakdown-PollenBreakdown--outlookLevel--2rf6z"]')

	count = 0;
	countTwo = -1;

	data = ""

	for x in items:
		if count%3 == 0 :
			countTwo = countTwo + 1
			if(count != 0):
				data += "}"
			data +=(types[countTwo] + "{") 
		elementString = etree.tostring(x)
		elementString = elementString.decode("utf-8")
		
		day = elementString[elementString.index("</svg></div>")+12:elementString.index("strong")-3]
		
		measurement = elementString[elementString.index("strong"):]
		measurement = measurement[7:]
		measurement = measurement[:measurement.index("<")]
		data += day + ": " + measurement + ","
		count = count+1
		if(count == len(items)):
				data += "}"

	ctime = datetime.now().strftime('%H:%M %Y-%m-%d')
	print("Program ran at:", ctime)

	with open('data.txt', 'w') as f:
		f.write(data)
		

schedule.every().day.at("01:00").do(job,'It is 01:00')

while True:
    schedule.run_pending()
    time.sleep(60) # wait one minute