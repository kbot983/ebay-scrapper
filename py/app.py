#Python program to scrape website  
#and save quotes from website 
import requests 
from bs4 import BeautifulSoup 
import csv
import mysql.connector

mydb = mysql.connector.connect(
  host="db",
  user="root",
  passwd="it635"
)

print(mydb)
def scrapper():
    URL = "https://www.ebay.com/itm/Superdry-Mens-Surplus-Goods-Shadow-Bomber-Jacket/323970731372?hash=item4b6e290d6c%3Am%3AmBBzvdspWQK51inPy7CHqjg&_trkparms=%2526rpp_cid%253D5d76b855c9f83175369f6d2f&var=513012879646"
    r = requests.get(URL) 
    
    soup = BeautifulSoup(r.content, 'html5lib') 
    
    quotes=[]  # a list to store quotes 
    
    price = soup.find('span', attrs = {'id':'prcIsum'}) 
    title = URL.split("/", 8)[4]

    print("Item title " + title +  "\nItem Price " + price.text)  
    # filename = 'inspirational_quotes.csv'
    # with open(filename, 'wb') as f: 
    #     w = csv.DictWriter(f,['theme','url','img','lines','author']) 
    #     w.writeheader() 
    #     for quote in quotes: 
    #         w.writerow(quote) 

scrapper()
