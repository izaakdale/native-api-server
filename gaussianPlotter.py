#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Created on Mon May 16 10:58:08 2022

@author: izaakdale
"""

import pandas as pd
import requests as rq

tokenHeaders = {'clientId':'izaak', 'clientSecret':'secretI'}
tokenResponse = rq.get("http://localhost:8080/api/token", headers=tokenHeaders)
token = tokenResponse.json()['token']

gaussHeaders = {
    'Authorization': token,
    'mu': "0",
    'theta': "1",
    'minX': "-5",
    'maxX': "5",
    'noDatapoints': "100"
    }

gaussResponse = rq.get("http://localhost:8080/api/gaussian", headers=gaussHeaders)

df = pd.DataFrame(gaussResponse.json())
df.plot(x='x', y='y', kind='line')