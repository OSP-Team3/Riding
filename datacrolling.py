# -*- coding: utf-8 -*-
"""
Created on Sat Nov 23 23:08:09 2019

@author: Joy
"""
from selenium import webdriver
from selenium.common.exceptions import NoSuchElementException
import time
import pandas as pd

url='http://adventure.lotteworld.com/kor/enjoy/attrctn/list.do'
driver=webdriver.Chrome('/Users/Joy/Desktop/chromedriver')

driver.implicitly_wait(3)

driver.get(url)
attrList=driver.find_elements_by_xpath("//a[@class='listItem']")

park_id="04"
num=1

result=[]

for i in range(len(attrList)):
    driver.execute_script("arguments[0].click();", attrList[i])
    time.sleep(3)
    
    if num<10:
        str_num="0"+str(num)
    else:
        str_num=str(num)
    
    attr_id=park_id+str_num
    num=num+1
    name=driver.find_element_by_xpath("//h2").text+""
    explain=driver.find_element_by_xpath("//p[@class='h2Txt']").text+""
    try:
        passenger=driver.find_element_by_xpath("//p[@class='boldTxt']").text+""
    except NoSuchElementException:
        passenger=""
    
    try:
        etc=driver.find_element_by_xpath("//p[@class='lightTxt']").text+""
    except NoSuchElementException:
        etc=""
    a=[]
    a.append(attr_id)
    a.append(name)
    a.append(explain)
    a.append(passenger)
    a.append(etc)
    
    result.append(a)
    
    driver.back()
    attrList=driver.find_elements_by_xpath("//a[@class='listItem']")
    
    
data=pd.DataFrame(result)
data.to_csv('result.csv', encoding='cp949')