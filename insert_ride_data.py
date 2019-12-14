# -*- coding: utf-8 -*-
"""
Created on Tue Dec  3 10:46:02 2019

@author: Joy
"""

import pandas as pd
import numpy as np
import os
import math

base_dir="C:/Users/joy/Desktop"
excel_file='lotte_ride.xlsx'
excel_dir=os.path.join(base_dir,excel_file)

data=pd.read_excel(excel_dir)

f = open("insert_ride_lotte.txt", 'w')

print(data)

for i in range(len(data)):
    park_id=str(data['park_id'][i])
    ride_id=str(data['ride_id'][i])
    name=data['name'][i]
    desc=str(data['description'][i])
    passenger=data['passenger'][i]
    if math.isnan(passenger): 
        passenger=""
    else:
        passenger=str(passenger)
    
    min_h=data['min_h'][i]    
    if math.isnan(min_h): 
        min_h=""
    else:
        min_h=str(min_h)

    max_h=data['max_h'][i]    
    
    if math.isnan(max_h): 
        max_h=""
    else:
        max_h=str(max_h)
        

    insert_data="insert into Ride values ("+park_id+", "+ride_id+", '"+name+"', '"+desc+"', "+passenger+", "+min_h+", "+max_h+");\n"
    print(insert_data)
    f.write(insert_data)
    
f.close()
    