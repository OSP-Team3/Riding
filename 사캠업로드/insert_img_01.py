# -*- coding: utf-8 -*-
"""
Created on Tue Dec  3 10:46:02 2019

@author: Joy
"""


folder_link="C:/Users/User/Downloads/01img/"
f = open("insert_img_link01.txt", 'w')

ride_id=101

for i in range(len(data)):
    img_link=folder_link+str(ride_id)
    insert_data="insert into Ride_img values ("+str(ride_id)+", '"+img_link+"');\n"
    print(insert_data)
    f.write(insert_data)
    
f.close()
    