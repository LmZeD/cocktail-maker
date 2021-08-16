import bluetooth, sys

addr = "98:D3:71:F9:CF:2E" #BT device MAC address

try:
    conn = bluetooth.BluetoothSocket(bluetooth.RFCOMM)
    conn.connect((addr,1))
except bluetooth.btcommon.BluetoothError as err:
    print(err)
    pass

def activatePump(pumpNo, time):
    conn.send("|"+pumpNo+":"+time+"|")

if __name__ == "__main__":
    activatePump(sys.argv[1], sys.argv[2])
