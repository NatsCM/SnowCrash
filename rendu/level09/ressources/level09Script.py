#!/usr/bin/env python2

import sys, os

def rev(s, start=0):
    M = 0x110000
    return u''.join(unichr((ord(ch) - (i - start)) % M) for i, ch in enumerate(s))

arg = sys.argv[1] if len(sys.argv) > 1 else '-'
raw = sys.stdin.read() if arg == '-' else (open(arg, 'rb').read() if os.path.exists(arg) else arg)
try:
    data = raw.decode('utf-8')
except:
    data = raw.decode('latin-1')

sys.stdout.write(rev(data).encode('utf-8'))