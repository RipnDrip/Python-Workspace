from socket import *
import random
# address to run server
port = ("localhost", 25384)
s = socket(AF_INET, SOCK_DGRAM)
# binding address
s.bind(port)
print("Server Loading...")
while 1:
    # receiving the data from client
    data, address = s.recvfrom(4096)
    data = data.decode()
    data = data.split(',')
    # printing data from client
    print("Client Name: ", data[0])
    print("Server name: " + str(address))
    # generating random number
    n = random.randint(1, 100)
    # getting sum
    sum_of_n = n + int(data[1])
    # sending to client
    msg = f'Server of {data[0][10:]},'+str(n)+","+str(sum_of_n)
    # sending back to server
    s.sendto(msg.encode(), address)