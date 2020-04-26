from flask import Flask, request, jsonify
import mysql.connector
from bs4 import BeautifulSoup
import requests as r 

app = Flask(__name__)

@app.route('/')
def index():
    return 'Heelo World!'

@app.route("/getdata", methods=["POST"])
def getebaydata():
    input_json = request.get_json(force=True) 
    URL = input_json['url']
    resp = r.get(URL) 
    
    soup = BeautifulSoup(resp.content, 'html5lib') 
    
    price = soup.find('span', attrs = {'id':'prcIsum'}) 
    price = price.text[4:]
    price = float(price.replace(',', ''))
    title = URL.split("/", 8)[4]

    # print("Item title " + title +  "\nItem Price " + price.text)
    output_json = {"item-title": title, "item-price": price}  
    # result = "{'test': 'success'}"
    return jsonify(output_json)


def _test(argument):
    return "TEST: %s" % argument

if __name__ == '__main__':
    app.run(host='0.0.0.0')