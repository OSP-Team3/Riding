# -*- coding: utf-8 -*-
"""
Created on Sat Nov 23 23:08:09 2019

@author: Joy
"""
from selenium import webdriver
from selenium.common.exceptions import NoSuchElementException
import time

url='https://www.gjw.co.kr/Contents/contents.php?cmsNo=DB0200'
driver=webdriver.Chrome('/Users/Joy/Desktop/chromedriver')

driver.implicitly_wait(3)

driver.get(url)

button=driver.find_element_by_xpath("//*[@id='GetMore']")
for i in range(3):
    driver.execute_script("arguments[0].click();", button)
    time.sleep(2)
    
attrList=driver.find_elements_by_xpath("//div[@class='photo']")
    
park_id="1"
num=1


"""f = open("insert_img_src01.txt", 'w')

for i in range(len(attrList)):
    a=attrList[i].find_element_by_tag_name("a")
    img=a.find_element_by_tag_name("img")
    src=img.get_attribute("src")
    
    if num<10: 
        ride_id=park_id+"0"+str(num)
    else:
        ride_id=park_id+str(num)
    
    num=num+1
    
    insert_img="insert into Ride_img values ("+ride_id+", '"+src+"');\n"
    print(insert_img)
    
    f.write(insert_img)
    

f.close()"""