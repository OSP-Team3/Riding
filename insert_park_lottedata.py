# -*- coding: utf-8 -*-
"""
Created on Tue Dec  3 10:46:02 2019

@author: Joy
"""

import pandas as pd
import numpy as np
import os

base_dir="C:/Users/joy/Desktop"
excel_file='lotte.xlsx'
excel_dir=os.path.join(base_dir,excel_file)

data=pd.read_excel(excel_dir)

f = open("insert_park_lotte.txt", 'w')

print(len(data))

for i in range(len(data)):
    insert_data="insert into Park values ("+str(data['park_id'][i])+", "+str(data['ride_id'][i])+");\n"
    print(insert_data)
    f.write(insert_data)
    
f.close()
    