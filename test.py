#!/usr/bin/python
import sys
import os
sys.path.append("/home/pibs16/.local/lib/python3.8/site-packages")
os.chdir("/home/pibs16/.local/lib/python3.8/site-packages")
print(os.getcwd())
print(sys.path)
import numpy as np

print("Content-Type: text/html\n\n")

print("Hello world! Python works!")
