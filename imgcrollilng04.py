# -*- coding: utf-8 -*-
"""
Created on Sat Nov 23 23:08:09 2019

@author: Joy
"""
from selenium import webdriver
from selenium.common.exceptions import NoSuchElementException
import time

url='http://adventure.lotteworld.com/kor/enjoy/attrctn/list.do'
driver=webdriver.Chrome('/Users/User/Downloads/chromedriver')

driver.implicitly_wait(3)

driver.get(url)
attrList=driver.find_elements_by_xpath("//a[@class='listItem']")

park_id="4"
num=1

result=[]

f = open("insert_img_src.txt", 'w')

for i in range(len(attrList)):
    driver.execute_script("arguments[0].click();", attrList[i])
    time.sleep(3)
    
    wrapper=driver.find_element_by_xpath("//div[@class='swiper-wrapper']")

    div=wrapper.find_element_by_tag_name("div")
    img=div.find_element_by_tag_name("img")
    src=img.get_attribute("src")
    
    if num<10: 
        ride_id=park_id+"0"+str(num)
    else:
        ride_id=park_id+str(num)
    
    num=num+1
    
    insert_img="insert into Ride_img values ("+ride_id+", '"+src+"');\n"
    print(insert_img)
    
    f.write(insert_img)
    
    driver.back()
    attrList=driver.find_elements_by_xpath("//a[@class='listItem']")
    
    
"""data=pd.DataFrame(result)
data.to_csv('result.csv', encoding='cp949')"""
f.close()